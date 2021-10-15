# Changelog

All notable changes to this project will be documented in this file.

The format is based on [keep a changelog][xtlink-keep-a-changelog]
and this project adheres to [Semantic Versioning 2.0.0][xtlink-semantic-versioning].

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
