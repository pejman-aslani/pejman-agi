# Pejman AGI -  کتابخانه AGI فارسی برای Asterisk (2025)

[![Latest Version](https://img.shields.io/packagist/v/pejmanaslani/agi.svg?style=flat-square)](https://packagist.org/packages/pejmanaslani/agi)
[![PHP 8.2+](https://img.shields.io/packagist/php-v/pejmanaslani/agi.svg?style=flat-square)](https://php.net)
[![Total Downloads](https://img.shields.io/packagist/dt/pejmanaslani/agi.svg?style=flat-square)](https://packagist.org/packages/pejmanaslani/agi)
[![License MIT](https://img.shields.io/packagist/l/pejmanaslani/agi.svg?style=flat-square)](LICENSE)

کتابخانه AGI مدرن، کاملاً type-safe و با TTS فارسی فوق‌العاده (Piper لوکال) برای Asterisk

### ویژگی‌های کلیدی
- PHP 8.3+ با strict types و attributes
- Command Pattern کاملاً تایپ‌شده (بدون magic method)
- امنیت بالا (بدون shell_exec، path traversal بلاک شده)
- PSR-3 Logging
- آماده FastAGI با ReactPHP (به زودی)
- کاملاً تست‌شده با PHPUnit + PHPStan level 9

### نصب

```bash
composer require pejmanaslani/agi
