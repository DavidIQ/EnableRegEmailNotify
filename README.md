# Enable e-mail notifications on registration

## Installation

Copy the extension to phpBB/ext/davidiq/EnableRegEmailNotify

Go to "ACP" > "Customise" > "Extensions" and enable the "Enable e-mail notifications on registration" extension.

## Tests and Continuous Integration

We use Travis-CI as a continuous integration server and phpunit for our unit testing. See more information on the [phpBB development wiki](https://wiki.phpbb.com/Unit_Tests).
To run the tests locally, you need to install phpBB from its Git repository. Afterwards run the following command from the phpBB Git repository's root:

Windows:

    phpBB\vendor\bin\phpunit.bat -c phpBB\ext\davidiq\EnableRegEmailNotify\phpunit.xml.dist

others:

    phpBB/vendor/bin/phpunit -c phpBB/ext/davidiq/EnableRegEmailNotify/phpunit.xml.dist

## License

[GPLv2](license.txt)
