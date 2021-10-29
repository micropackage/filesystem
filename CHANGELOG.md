# Changelog
All notable changes to this project will be documented in this file.

## 1.1.4

### Changed:
- Allows mkdir method to get empty parameter.

## 1.1.3 - 15.06.2020

### Fixed:
- WP_CONTENT_URL not returning proper protocol. Replaced with `content_url()`, thanks to @matt-bernhardt

## 1.1.3 - 15.06.2020

### Fixed:
- WP_CONTENT_URL not returning proper protocol. Replaced with `content_url()`, thanks to @matt-bernhardt

## 1.1.2 - 10.02.2020

### Changed:
- WP Filesystem is not cached scroll all Filesystem instances for better performance.

## 1.1.1 - 05.02.2020

### Fixed:
- Path to URL rewrite on Windows machines. The WP_CONTENT_DIR is now normalized.

## 1.1.0 - 29.01.2020

### Added:
- mkdir support for recursive dir creation when using Direct method.

### Fixed:
- Invalid method name causing warning.

## 1.0.0 - 28.01.2020

Initial release
