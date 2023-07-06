# Changelog

All notable changes to this project will be documented in this file.

The format is based on [keep a changelog][xtlink-keep-a-changelog]
and this project adheres to [Semantic Versioning 2.0.0][xtlink-semantic-versioning].

## [0.5.1] - 2023-07-06

### Fixed

* added session options validation
* sets session options

[0.5.1]: https://github.com/codekandis/session/compare/0.5.0..0.5.1

---
## [0.5.0] - 2022-05-11

### Changed

* composer package dependencies
  * removed
    * `codekandis/configurations`
  * changed
    * description

[0.5.0]: https://github.com/codekandis/session/compare/0.4.1..0.5.0

---
## [0.4.1] - 2022-01-03

### Fixed

* session save path
* exception conditions

[0.4.1]: https://github.com/codekandis/session/compare/0.4.0..0.4.1

---
## [0.4.0] - 2021-10-19

### Added

* sessions configuration
* advanced error handling

### Changed

* composer package dependencies
    * added
        * `codekandis/configurations` [^0]
* replaced initial session handler values with sessions configuration

[0.4.0]: https://github.com/codekandis/session/compare/0.3.0..0.4.0

---
## [0.3.0] - 2021-10-15

### Added

* exception on session start
* methods to change the session save path

[0.3.0]: https://github.com/codekandis/session/compare/0.2.0..0.3.0

---
## [0.2.0] - 2021-01-29

### Changed

* composer package dependencies
    * removed
        * `sensiolabs/security-checker`
        * `phpunit/phpunit`
    * changed
        * `minimum-stability` [true]
    * added
        * `codekandis/phpunit` [^3]
* `PHPUnit` configuration

[0.2.0]: https://github.com/codekandis/session/compare/0.1.0..0.2.0

---
## [0.1.0] - 2020-09-28

### Added

* `SessionHandlerInterface`
* `SessionHandler`
* `SessionOptions`
* `SessionStatus`
* `LICENSE`
* `README.md`
* `CHANGELOG.md`

[0.1.0]: https://github.com/codekandis/session/tree/0.1.0



[xtlink-keep-a-changelog]: http://keepachangelog.com/en/1.0.0/
[xtlink-semantic-versioning]: http://semver.org/spec/v2.0.0.html
