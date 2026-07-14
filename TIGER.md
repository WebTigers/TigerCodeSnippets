# Tiger Utility Snippets

A small pack of **PHP helper snippets** for the [Tiger](https://github.com/WebTigers/TigerCore)
platform — the kind of one-liners every app ends up re-writing. Install it, then **activate the
ones you want** in the **Code Area**.

This is a **`code` module**: it ships no routes, controllers, or database — just helpers. Each
snippet is a single self-describing file that defines one global function, guarded with
`function_exists()` so it never clashes.

## What's in the pack

| Function | Does |
|---|---|
| `slug($s)` | `"Hello, World!"` → `"hello-world"` (lowercase, URL-safe) |
| `human_bytes($n)` | `1536` → `"1.5 KB"` |
| `time_ago($time)` | a timestamp/date → `"3 hours ago"` |
| `ordinal($n)` | `1` → `"1st"`, `22` → `"22nd"` |
| `initials($name)` | `"John Doe"` → `"JD"` (great for avatars) |
| `array_get($arr, 'a.b.c', $default)` | read a nested array value by dot-path |

## Install & activate

1. **Modules → Add New → Browse** (or install from this repo's URL). Install **Tiger Utility
   Snippets**.
2. Open the **Code Area**. The pack's snippets appear there **inactive**.
3. **Read the source** (it's right there — these are plain, readable helpers), then **activate**
   the ones you want. Active snippets load app-wide; every activated function is available in
   your PHP.

## Safety

Activating a code snippet **runs its PHP in your app** — so it's superadmin-only, never
auto-activated, shown in full before you turn it on, and lint-checked. These snippets are
deliberately simple and dependency-free; read them and decide. See the platform's `CODE.md` for
the full trust model.

## License

MIT — use them anywhere. © [WebTigers](https://webtigers.com).
