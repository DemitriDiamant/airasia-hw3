# AirAsia HW3 – Testing Report

## Project Overview
This project is an AirAsia Rewards gift card management website built using PHP and SQLite. The application allows users to view, add, update, and delete gift cards.

## Functional Testing

| Test | Result |
|---|---|
| Display gift card list | Passed |
| View gift card details | Passed |
| Add a new gift card | Passed |
| Update an existing gift card | Passed |
| Delete a gift card | Passed |
| Prevent empty required fields | Passed |
| Reject negative gift card values | Passed |
| Reject negative reward points | Passed |

## Server-Side Validation Testing

I tested the Add Gift Card and Update Gift Card pages using terminal commands to send invalid information directly to the PHP server.

The Add Gift Card page returned the following errors:
- Enter a valid gift card value.
- Enter valid points required.

The Update Gift Card page returned the following errors:
- Enter a valid card value.
- Enter valid reward points.

Both pages rejected the invalid submissions.

## Automated Validation Tests

I created `tests/validation-tests.php` to test the reusable validation function.

The seven tests covered:
1. Valid gift card information
2. Empty gift card name
3. Empty gift card type
4. Negative gift card value
5. Negative reward points
6. Zero reward points
7. Nonnumeric gift card value

**Automated test results: 7 passed, 0 failed.**

## Issues and Fixes

During development, I fixed problems with the gift card Add, Update, and Delete pages. I also corrected the styling of the Update and Delete buttons so their text was visible.

I tested the application again after making these changes.

## Conclusion

The main gift card management features worked during manual testing. The PHP validation checks rejected invalid negative values, and all seven automated validation tests passed.