# AirAsia HW3 - Gift Card Management

## Project Description
This project is an AirAsia Rewards gift card management website built using PHP, SQLite, HTML, and CSS. Users can view available gift cards and add, update, or delete gift card information.

## Features
- Display available gift cards
- View individual gift card details
- Add new gift cards
- Update existing gift cards
- Delete gift cards
- Validate gift card information
- Store gift card information in an SQLite database

## How to Run
1. Open the project in GitHub Codespaces.
2. Open the terminal.
3. Start the PHP server using:

   `php -S 0.0.0.0:8080 -t /workspaces/airasia-hw3`

4. Open Port 8080 in your browser.
5. Navigate to `card-list.php` to view the gift cards.

## Testing
I manually tested the Add, Update, and Delete features to make sure they worked correctly. I also tested invalid gift card values and points.

To run the automated validation tests, enter:

`php tests/validation-tests.php`

Automated testing results: 7 passed, 0 failed.

## AI Assistance
I used ChatGPT to help with certain PHP features, file organization, validation testing, and troubleshooting errors. More information is included in `ai-use.txt`.