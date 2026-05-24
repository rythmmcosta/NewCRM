const { chromium } = require('playwright');

(async () => {
    const browser = await chromium.launch({ headless: true });
    const context = await browser.newContext();
    const page = await context.newPage();

    const credentials = {
        email: 'admin@esmart.com.bd',
        password: 'admin!esmart50'
    };

    // Use 127.0.0.1 instead of localhost for stability in some environments
    const baseUrl = 'http://127.0.0.1:21471';

    try {
        console.log(`Navigating to ${baseUrl}/admin/login...`);
        // Increase timeout for slow server start
        await page.goto(`${baseUrl}/admin/login`, { waitUntil: 'networkidle', timeout: 60000 });
        console.log(`Current URL: ${page.url()}`);

        // Check console logs
        page.on('console', msg => {
            if (msg.type() === 'error') console.log(`JS Error: ${msg.text()}`);
        });

        // Fill credentials - use more specific selectors if possible
        console.log('Attempting login...');
        await page.waitForSelector('input[type="email"]', { timeout: 10000 });
        await page.fill('input[type="email"]', credentials.email);
        await page.fill('input[type="password"]', credentials.password);
        await page.click('button[type="submit"]');
        
        console.log('Waiting for Dashboard...');
        await page.waitForURL('**/admin', { timeout: 15000 });
        console.log('✅ Logged in successfully.');

        // Take screenshot of homepage
        await page.screenshot({ path: 'homepage_screenshot.png' });
        console.log('✅ Screenshot saved: homepage_screenshot.png');

        // Check Resources in Sidebar
        const sidebarContent = await page.innerText('nav') || await page.innerText('aside') || await page.content();
        const hasEmployees = sidebarContent.includes('Employees');
        const hasUsers = sidebarContent.includes('Users');
        console.log(`Resource Verification: Employees: ${hasEmployees}, Users: ${hasUsers}`);

        if (hasEmployees) {
            console.log('Navigating to Employees resource...');
            await page.click('a[href*="/admin/employees"]');
            await page.waitForURL('**/admin/employees');

            console.log('Clicking "New employee" button...');
            // In Filament 5, it might be an 'a' or 'button'
            await page.click('a[href*="/create"], button:has-text("New"), a:has-text("New")');
            await page.waitForURL('**/admin/employees/create');

            console.log('Filling employee details for Hridoy Islam...');
            // Filament fields often have names or specific IDs
            await page.fill('input[name*="name"]', 'Hridoy Islam');
            await page.fill('input[name*="email"]', 'hridoy@esmart.com.bd');
            await page.fill('input[name*="phone"]', '01712345678');
            await page.fill('input[name*="designation"]', 'Software Engineer');
            
            console.log('Saving employee...');
            await page.click('button[type="submit"], button:has-text("Create")');
            
            await page.waitForTimeout(3000);
            console.log('✅ Employee "Hridoy Islam" added via UI.');
            await page.screenshot({ path: 'employee_created.png' });
        } else {
            console.log('❌ Could not find Employees resource in navigation.');
            await page.screenshot({ path: 'sidebar_not_found.png' });
        }

    } catch (error) {
        console.error('❌ Automation Error:', error.message);
        await page.screenshot({ path: 'automation_error.png' });
    } finally {
        await browser.close();
    }
})();
