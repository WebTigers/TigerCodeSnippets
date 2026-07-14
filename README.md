# Tiger Utility Snippets

A pack of small, dependency-free **PHP helper snippets** for the
[Tiger](https://github.com/WebTigers/TigerCore) platform — a `code` module for the **Code Area**.

Install it, open the Code Area, read the source, and **activate the helpers you want**. Each
becomes a global function available across your app.

## Snippets

- `slug($s)` — URL-safe slug
- `human_bytes($n)` — `1.5 KB`, `3.2 MB`, …
- `time_ago($time)` — `"3 hours ago"`
- `ordinal($n)` — `1st`, `2nd`, `23rd`
- `initials($name)` — `"John Doe"` → `"JD"`
- `array_get($arr, 'a.b.c', $default)` — dot-path array read

## How a `code` module works

Each file in [`snippets/`](snippets/) is self-describing:

```php
<?php
// tiger:snippet label="Slugify" category="String" scope="global"
//   description="slug($s): turn any string into a lowercase, URL-safe slug."

if (!function_exists('slug')) {
    function slug(string $s, string $sep = '-'): string { /* … */ }
}
```

The `tiger:snippet` header drives the Code Area listing; the body defines the helper (guarded
with `function_exists` so activating it can never fatally redeclare). No routes, no schema — just
code you opt into. See [`TIGER.md`](TIGER.md) and the platform's `CODE.md`.

## Contributing a snippet

Add a `snippets/<name>.php` file with a `tiger:snippet` header + a `function_exists`-guarded
function. Keep it small, readable, and side-effect-free on load (**define, don't do**).

## License

MIT — see [LICENSE](LICENSE).
