# Date Based Redirect Plugin

A WordPress plugin that redirects visitors based on date ranges configured in the admin interface. Ideal for setting up temporary redirects for promotions, offers, and events.

## Installation

1. **Download the Plugin:**
   - Download the `date-based-redirect.zip` file.

2. **Upload the Plugin:**
   - Go to your WordPress dashboard.
   - Navigate to `Plugins` > `Add New`.
   - Click `Upload Plugin` and select the `date-based-redirect.zip` file.
   - Click `Install Now` and then `Activate`.

3. **Manual Installation:**
   - Unzip the `date-based-redirect.zip` file.
   - Upload the entire `date-based-redirect` folder to the `/wp-content/plugins/` directory.
   - Go to `Plugins` in your WordPress dashboard and activate the `Date Based Redirect` plugin.

## Usage

1. **Configure the Plugin:**
   - Navigate to `Settings` > `Date Based Redirect`.
   - Fill in the required fields:
     - **URL Slug:** The part of the URL you want to set up the redirect for (e.g., `special-offer` for `https://yourwebsite.com/special-offer`).
     - **Date Ranges and Target URLs:** Add multiple date ranges and their corresponding target URLs.
     - **Default Target URL:** The URL to redirect to when no date range matches.

2. **Add Date Ranges:**
   - Click `Add Date Range` to add a new date range.
   - Specify the start date, end date (inclusive), and target URL for each date range.

3. **Save Changes:**
   - Click `Save Changes` to apply your settings.

## Examples

### Example 1: Special Offers

- **URL Slug:** `special-offer`
- **Date Ranges:**
  - **June Promotion:** 
    - Start Date: `2024-06-01`
    - End Date: `2024-06-30`
    - Target URL: `https://yourwebsite.com/june-promotion`
  - **July Promotion:** 
    - Start Date: `2024-07-01`
    - End Date: `2024-07-31`
    - Target URL: `https://yourwebsite.com/july-promotion`
- **Default Target URL:** `https://yourwebsite.com/offer-overview`

In this setup, visitors to `https://yourwebsite.com/special-offer` will be redirected to:
- `https://yourwebsite.com/june-promotion` during June 2024.
- `https://yourwebsite.com/july-promotion` during July 2024.
- `https://yourwebsite.com/offer-overview` at all other times.

### Example 2: Seasonal Sales

- **URL Slug:** `seasonal-sale`
- **Date Ranges:**
  - **Spring Sale:** 
    - Start Date: `2024-03-01`
    - End Date: `2024-03-31`
    - Target URL: `https://yourwebsite.com/spring-sale`
  - **Summer Sale:** 
    - Start Date: `2024-06-01`
    - End Date: `2024-06-30`
    - Target URL: `https://yourwebsite.com/summer-sale`
  - **Winter Sale:** 
    - Start Date: `2024-12-01`
    - End Date: `2024-12-31`
    - Target URL: `https://yourwebsite.com/winter-sale`
- **Default Target URL:** `https://yourwebsite.com/sale-overview`

In this setup, visitors to `https://yourwebsite.com/seasonal-sale` will be redirected to:
- `https://yourwebsite.com/spring-sale` during March 2024.
- `https://yourwebsite.com/summer-sale` during June 2024.
- `https://yourwebsite.com/winter-sale` during December 2024.
- `https://yourwebsite.com/sale-overview` at all other times.

## Notes

- The end date is inclusive, meaning visitors will be redirected on the end date as well.
- Ensure that the URL Slug matches the part of the URL you want to redirect from.
- You can add multiple date ranges to cover different periods and promotions.


---

Enjoy using the Date Based Redirect plugin for your WordPress site!
