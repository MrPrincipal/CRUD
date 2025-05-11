<?php
$conn = new mysqli('10.0.2.13', 'root', '', 'portfolio');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$about = $conn->query("SELECT content FROM about LIMIT 1")->fetch_assoc();
$certifications = $conn->query("SELECT content, link FROM certifications");
$skills = $conn->query("SELECT emoji, category, description FROM skills");
$experience = $conn->query("SELECT title, date_range, description FROM experience");
$contact = $conn->query("SELECT type, link FROM contact");

function sanitizeId($category) {
    return preg_replace('/[^a-zA-Z0-9]/', '_', $category);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nkurunziza Amos - Portfolio</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- Theme Styles -->
    <style>
        body.light-mode {
            background-color: #fff;
            color: #000;
        }

        body.dark-mode {
            background-color: #121212;
            color: #fff;
        }

        .theme-toggle-btn {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 999;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 2rem;
        }

        .header-image img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        nav ul li a {
            text-decoration: none;
        }

        .linkedin-icon {
            width: 24px;
            height: 24px;
        }

        .contact-buttons .btn {
            margin: 0.5rem;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <!-- Theme Toggle Button -->
    <button class="btn btn-secondary theme-toggle-btn" onclick="toggleTheme()">Switch Theme</button>

    <header>
        <div class="header-content">
            <div class="header-image">
                <img src="image/amos.jpg" alt="Amos's Image">
            </div>
            <div class="header-text">
                <h1>Nkurunziza Amos</h1>
                <p>CyberOps Associate | CC Certified | CNSP | Ethical Hacker</p>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="#certifications">Certificates</a></li>
                <li><a href="#skills-overview">Skills</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <main class="container">
        <section id="about">
            <h2>About Me</h2>
            <p><?php echo $about['content']; ?></p>
        </section>

        <section id="certifications">
            <h2>📜 Licenses and Certifications</h2>
            <p>
                I have earned over <strong>24 professional certifications</strong> in cybersecurity, networking, and IT
                from renowned organizations such as Cisco, ISC2, EC-Council, and Udemy.
            </p>
            <ul style="list-style: none; padding-left: 0;">
                <?php while ($cert = $certifications->fetch_assoc()): ?>
                    <li>
                        <a href="<?php echo $cert['link']; ?>" target="_blank"><?php echo $cert['content']; ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
            <p>For a full list of my certifications, please visit my LinkedIn profile:</p>
            <a href="https://www.linkedin.com/in/mugisha-prince-31b647252/details/certifications/" target="_blank">
                <img src="image/linkedin.jpeg" alt="LinkedIn Logo" class="linkedin-icon"> View on LinkedIn
            </a>
        </section>

        <section id="skills-overview">
            <h2>💼 Skills</h2>
            <div class="row">
                <?php while ($skill = $skills->fetch_assoc()): ?>
                    <?php $modalId = sanitizeId($skill['category']); ?>
                    <div class="col-md-4 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h3><?php echo $skill['emoji'] . ' ' . $skill['category']; ?></h3>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $modalId; ?>">
                                    Learn More
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-<?php echo $modalId; ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo $modalId; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $skill['emoji'] . ' ' . $skill['category']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><?php echo $skill['description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section id="experience">
            <h2>My Experience</h2>
            <div class="row">
                <?php while ($exp = $experience->fetch_assoc()): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h3><?php echo $exp['title']; ?></h3>
                                <p><?php echo $exp['date_range']; ?></p>
                                <p><?php echo $exp['description']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>

        <section id="contact">
            <h2>Contact Me</h2>
            <div class="contact-buttons">
                <?php while ($cont = $contact->fetch_assoc()): ?>
                    <a href="<?php echo $cont['link']; ?>" class="btn btn-primary" target="_blank">
                        <?php echo ucfirst($cont['type']); ?>
                    </a>
                <?php endwhile; ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Prince. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Toggle Script -->
    <script>
        function toggleTheme() {
            const body = document.body;
            const isDark = body.classList.contains('dark-mode');
            body.classList.toggle('dark-mode', !isDark);
            body.classList.toggle('light-mode', isDark);
            localStorage.setItem('theme', !isDark ? 'dark' : 'light');
        }

        // Load saved theme
        window.onload = () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
            } else {
                document.body.classList.add('light-mode');
            }
        };
    </script>
</body>
</html>
