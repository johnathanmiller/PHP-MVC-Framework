## 2.0.2, 2019-01-03
- Updated controller if statement in application class

## 2.0.1, 2019-01-03
- Updated composer package
- Updated property name in MySQL class
- Updated prod config file with SecureEnvPHP parse method

## 2.0.0, 2019-01-01
- Minimum PHP version requirement is 7.1
- Added PHP7 return type declarations
- Added capability to load multiple models in each view
- Added sass stylesheet files
- Updated config files to load dev/prod environment variables
- Updated views to utilize twig templates
- Restructured directories

## 1.0.21, 2018-05-13
- Added .gitignore
- Updated constant values in global config
- Updated construct method in application to capitalize the controller filename to be compatible with nginx

## 1.0.20, 2018-04-07
- Updated errors method in general to generate html in php and return as string
- Added comments to various methods

## 1.0.19, 2018-04-07
- Updated sidebar method in component class to check if file exists, otherwise throw an exception

## 1.0.18, 2018-03-07
- Added protected variable token_name in Security class
- Added renderCSRFInput method in Security class
- Updated contact/login/signup home views with new renderCSRFInput method

## 1.0.17, 2018-03-06
- Updated autoloader

## 1.0.16, 2018-03-06
- Updated constants

## 1.0.15, 2018-03-06
- Moved config into global, dev, and production files
- Error reporting enabled in dev
- Autoload file loads appropriate config file automatically

## 1.0.14, 2017-01-09
- Fixed broken tags in login and signup views

## 1.0.13, 2017-01-09
- Updated style.css

## 1.0.12, 2017-01-09
- Added redirectUser method in Url class (prevents users from viewing login and signup pages while logged in)

## 1.0.11, 2017-01-09
- Added check for minimum password length in signup view

## 1.0.10, 2017-01-09
- Extended User model
- Added login/logout/signup view methods and files
- Added User object to loadBeforeView in Controller class
- Added user session handling to home view header and nav
- Added error output method to General class

## 1.0.9, 2017-01-08
- Added soft fallback to 404 when view method exists but view file does not

## 1.0.8, 2017-01-07
- Changed site_title to non-static method and moved to Component class
- Added getDate method to General class
- Updated Controller
- Updated home view header

## 1.0.7, 2017-01-06
- Updated loadBeforeView method visibility to private

## 1.0.6, 2017-01-06
- Added Component class
- Added sidebar method to Component class
- Added loadBeforeView method to Controller class

## 1.0.5, 2017-01-06
- Cleaned up site_title method

## 1.0.4, 2017-01-05
- Added static method for dynamic site title

## 1.0.3, 2017-01-05
- Removed method_class variable
- Default controller for non-existent methods

## 1.0.2, 2017-01-04
- Added sidebar file

## 1.0.1, 2017-01-04
- Updated styling
- Added FontAwesome stylesheet in header
- Included sidebar to home view

## 1.0.0, 2017-01-04
- Initial release