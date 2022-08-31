# PHPSecurityTools

[![PHP](https://img.shields.io/badge/PHP-^8.1-777bb3.svg?logo=php&logoColor=white&labelColor=555555&style=flat)](https://www.php.net/supported-versions.php)
[![PHPStan](https://img.shields.io/badge/PHPStan-Level%20Max-brightgreen.svg?style=flat)](https://phpstan.org/user-guide/rule-levels)
[![LICENSE](https://img.shields.io/github/license/bjoern-hempel/php-calendar-api)](https://github.com/bjoern-hempel/php-calendar-api/blob/master/LICENSE.md)

> A framework which provides security and analysis tools in the web sector.

## Commands

### Domain

#### DNS

```bash
❯ bin/console domain:dns:get-a-record fake.ixno.de
```

```bash
[Thu, 01 Sep 2022 00:35:22 +0200] (Domain:DNS:A-Record) fake.ixno.de → 1.2.3.4
```

```bash
❯ bin/console domain:dns:get-a-record fake.ixno.de --all
```

```bash
[Thu, 01 Sep 2022 00:35:03 +0200] (Domain:DNS:A-Record) fake.ixno.de → host = fake.ixno.de, class = IN, ttl = 0, type = A, ip = 1.2.3.4
```

```bash
❯ bin/console domain:dns:get-mx-record fake.ixno.de
```

```bash
[Thu, 01 Sep 2022 00:35:36 +0200] (Domain:DNS:MX-Record) fake.ixno.de → mail.fake.ixno.de
```

```bash
❯ bin/console domain:dns:get-mx-record fake.ixno.de --all
```

```bash
[Thu, 01 Sep 2022 00:34:47 +0200] (Domain:DNS:MX-Record) fake.ixno.de → host = fake.ixno.de, class = IN, ttl = 0, type = MX, pri = 10, target = mail.fake.ixno.de
```