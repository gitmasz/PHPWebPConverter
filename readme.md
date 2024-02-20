# PHP WebP Converter
Example of how to generate webp image file from jpg or png image file with PHP. Created for learning purpose. Example project.

## How to run it on local XAMPP server
To use imagecreatefromstring PHP function (which is used in this example project) You need GD library. This library is probably active on Your online server but it is disabled by disabled for default on XAMPP. To activate GD library follow steps below (for XAMPP with PHP 8 support).
1. Go to xampp control panel
2. Click Config Button
3. From Dropdown open file PHP (php.ini)
4. Fine ;extension=gd
5. Remove ; from start
6. Restart XAMPP server