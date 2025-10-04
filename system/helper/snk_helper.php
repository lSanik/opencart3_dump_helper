//Debug
if (isset($_COOKIE['dev_mark']) || isset($_GET['dev_mark'])) {
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    if (!function_exists('fdd')) {
        function fdd(...$vars) { dumpVar(true, ...$vars); }
    }
    if (!function_exists('fvd')) {
        function fvd(...$vars) { dumpVar(false, ...$vars); }
    }
} else {
    if (!function_exists('fdd')) {
        function fdd(...$vars) {}
    }
    if (!function_exists('fvd')) {
        function fvd(...$vars) {}
    }
}

if (!function_exists('dumpVar')) {
    function dumpVar($exit = false, ...$vars) {
        $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $caller = $bt[2] ?? ($bt[1] ?? $bt[0]);

        $file = $caller['file'] ?? 'unknown';
        $line = $caller['line'] ?? 0;

        echo '<div style="background:#222;color:#0f0;padding:10px;margin:10px 0;border-radius:8px;font-family:monospace">';
        echo "<div style='color:#ff0;margin-bottom:5px;'>Dump at <b>{$file}:{$line}</b></div>";

        foreach ($vars as $var) {
            echo "<pre style=\"background:#111;color:#fff;padding:10px;margin:5px 0;border-radius:6px;white-space:pre-wrap;word-wrap:break-word;\">";
            var_dump($var);
            echo '</pre>';
        }

        echo '</div>';

        if ($exit) {
            die();
        }
    }
}

if (!function_exists('dd')) {
    function dd(...$vars) { dumpVar(true, ...$vars); }
}

if (!function_exists('vd')) {
    function vd(...$vars) { dumpVar(false, ...$vars); }
}
