<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'HealthLabs Patient Portal'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        black: "#000000",
                        white: "#FFFFFF",
                        gray: {
                            50: "#FAFAFA",
                            100: "#F5F5F5",
                            200: "#E5E5E5",
                            300: "#D4D4D4",
                            400: "#A3A3A3",
                            500: "#737373",
                            600: "#525252",
                            700: "#404040",
                            800: "#262626",
                            900: "#171717",
                            950: "#0A0A0A"
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-black text-white">
    <?php include __DIR__ . '/partials/nav.php'; ?>
    <main class="container mx-auto px-4 py-8">
        <?php echo $content ?? ''; ?>
    </main>
    <?php include __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
