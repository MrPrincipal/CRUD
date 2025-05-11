<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit;
}

$conn = new mysqli('10.0.2.13', 'root', '', 'portfolio');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$about = $conn->query("SELECT content FROM about LIMIT 1")->fetch_assoc();
$certifications = $conn->query("SELECT id, content, link FROM certifications");
$skills = $conn->query("SELECT id, emoji, category, description FROM skills");
$experience = $conn->query("SELECT id, title, date_range, description FROM experience");
$contact = $conn->query("SELECT id, type, link FROM contact");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['about'])) {
        $content = $conn->real_escape_string($_POST['about_content']);
        $conn->query("UPDATE about SET content = '$content' WHERE id = 1");
    }

    if (isset($_POST['certification'])) {
        $id = $_POST['certification_id'];
        $content = $conn->real_escape_string($_POST['certification_content']);
        $link = $conn->real_escape_string($_POST['certification_link']);
        
        if ($id) {
            $conn->query("UPDATE certifications SET content = '$content', link = '$link' WHERE id = $id");
        } else {
            $conn->query("INSERT INTO certifications (content, link) VALUES ('$content', '$link')");
        }
    }

    if (isset($_POST['skill'])) {
        $id = $_POST['skill_id'];
        $emoji = $_POST['skill_emoji'];
        $category = $conn->real_escape_string($_POST['skill_category']);
        $description = $conn->real_escape_string($_POST['skill_description']);
        
        if ($id) {
            $conn->query("UPDATE skills SET emoji = '$emoji', category = '$category', description = '$description' WHERE id = $id");
        } else {
            $conn->query("INSERT INTO skills (emoji, category, description) VALUES ('$emoji', '$category', '$description')");
        }
    }

    if (isset($_POST['experience'])) {
        $id = $_POST['experience_id'];
        $title = $conn->real_escape_string($_POST['experience_title']);
        $date_range = $conn->real_escape_string($_POST['experience_date_range']);
        $description = $conn->real_escape_string($_POST['experience_description']);
        
        if ($id) {
            $conn->query("UPDATE experience SET title = '$title', date_range = '$date_range', description = '$description' WHERE id = $id");
        } else {
            $conn->query("INSERT INTO experience (title, date_range, description) VALUES ('$title', '$date_range', '$description')");
        }
    }

    if (isset($_POST['contact'])) {
        $id = $_POST['contact_id'];
        $type = $_POST['contact_type'];
        $link = $conn->real_escape_string($_POST['contact_link']);
        
        if ($id) {
            $conn->query("UPDATE contact SET type = '$type', link = '$link' WHERE id = $id");
        } else {
            $conn->query("INSERT INTO contact (type, link) VALUES ('$type', '$link')");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prince - Portfolio Management</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <header>
        <div class="header-content">
            <div class="header-image">
                <img src="image/amos.jpg" alt="MUGISHA Prince's image" />
            </div>
            <div class="header-text">
                <h1>Manage Portfolio</h1>
                <p>CyberOps Associate | CC Certified | CNSP | Ethical Hacker</p>
            </div>
        </div>
    </header>

    <main>
        <section id="about">
            <h2>About Me</h2>
            <p><?php echo $about['content']; ?></p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#aboutModal">Edit About</button>
        </section>

        <section id="certifications">
            <h2>📜 Licenses and Certifications</h2>
            <ul>
                <?php while ($cert = $certifications->fetch_assoc()): ?>
                    <li>
                        <?php echo $cert['content']; ?>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#certificationModal" data-id="<?php echo $cert['id']; ?>" data-content="<?php echo $cert['content']; ?>" data-link="<?php echo $cert['link']; ?>">Edit</button>
                    </li>
                <?php endwhile; ?>
            </ul>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#certificationModal">Add Certification</button>
        </section>

        <section id="skills">
            <h2>💼 Skills</h2>
            <div class="row">
                <?php while ($skill = $skills->fetch_assoc()): ?>
                    <div class="col-md-4 mb-3">
                        <h3><?php echo $skill['emoji'] . ' ' . $skill['category']; ?></h3>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#skillModal" data-id="<?php echo $skill['id']; ?>" data-emoji="<?php echo $skill['emoji']; ?>" data-category="<?php echo $skill['category']; ?>" data-description="<?php echo $skill['description']; ?>">Edit</button>
                    </div>
                <?php endwhile; ?>
            </div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#skillModal">Add Skill</button>
        </section>

        <section id="experience">
            <h2>My Experience</h2>
            <div class="row">
                <?php while ($exp = $experience->fetch_assoc()): ?>
                    <div class="col-md-4 mb-3">
                        <h3><?php echo $exp['title']; ?></h3>
                        <p><?php echo $exp['date_range']; ?></p>
                        <p><?php echo $exp['description']; ?></p>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#experienceModal" data-id="<?php echo $exp['id']; ?>" data-title="<?php echo $exp['title']; ?>" data-date_range="<?php echo $exp['date_range']; ?>" data-description="<?php echo $exp['description']; ?>">Edit</button>
                    </div>
                <?php endwhile; ?>
            </div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#experienceModal">Add Experience</button>
        </section>

        <section id="contact">
            <h2>Contact Me</h2>
            <div class="contact-buttons">
                <?php while ($cont = $contact->fetch_assoc()): ?>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#contactModal" data-id="<?php echo $cont['id']; ?>" data-type="<?php echo $cont['type']; ?>" data-link="<?php echo $cont['link']; ?>">Edit</button>
                <?php endwhile; ?>
            </div>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#contactModal">Add Contact</button>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Prince. All rights reserved.</p>
    </footer>

    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="aboutModalLabel">Edit About</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <textarea name="about_content" class="form-control" rows="5"><?php echo $about['content']; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="about" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="certificationModal" tabindex="-1" aria-labelledby="certificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="certificationModalLabel">Edit Certification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="certification_id" id="certification_id">
                        <div class="mb-3">
                            <label for="certification_content" class="form-label">Certification Content</label>
                            <input type="text" name="certification_content" id="certification_content" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="certification_link" class="form-label">Certification Link</label>
                            <input type="url" name="certification_link" id="certification_link" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="certification" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="skillModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="skillModalLabel">Edit Skill</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="skill_id" id="skill_id">
                        <div class="mb-3">
                            <label for="skill_emoji" class="form-label">Emoji</label>
                            <input type="text" name="skill_emoji" id="skill_emoji" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="skill_category" class="form-label">Category</label>
                            <input type="text" name="skill_category" id="skill_category" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="skill_description" class="form-label">Description</label>
                            <textarea name="skill_description" id="skill_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="skill" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="experienceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="experienceModalLabel">Edit Experience</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="experience_id" id="experience_id">
                        <div class="mb-3">
                            <label for="experience_title" class="form-label">Title</label>
                            <input type="text" name="experience_title" id="experience_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="experience_date_range" class="form-label">Date Range</label>
                            <input type="text" name="experience_date_range" id="experience_date_range" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="experience_description" class="form-label">Description</label>
                            <textarea name="experience_description" id="experience_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="experience" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="manage.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="contactModalLabel">Edit Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="contact_id" id="contact_id">
                        <div class="mb-3">
                            <label for="contact_type" class="form-label">Contact Type</label>
                            <input type="text" name="contact_type" id="contact_type" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="contact_link" class="form-label">Contact Link</label>
                            <input type="url" name="contact_link" id="contact_link" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="contact" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', () => {
                const target = button.getAttribute('data-bs-target').slice(1);
                const id = button.getAttribute('data-id');
                const content = button.getAttribute('data-content');
                const link = button.getAttribute('data-link');
                const emoji = button.getAttribute('data-emoji');
                const category = button.getAttribute('data-category');
                const description = button.getAttribute('data-description');
                const title = button.getAttribute('data-title');
                const dateRange = button.getAttribute('data-date_range');

                if (target === 'certificationModal') {
                    document.getElementById('certification_id').value = id;
                    document.getElementById('certification_content').value = content;
                    document.getElementById('certification_link').value = link;
                } else if (target === 'skillModal') {
                    document.getElementById('skill_id').value = id;
                    document.getElementById('skill_emoji').value = emoji;
                    document.getElementById('skill_category').value = category;
                    document.getElementById('skill_description').value = description;
                } else if (target === 'experienceModal') {
                    document.getElementById('experience_id').value = id;
                    document.getElementById('experience_title').value = title;
                    document.getElementById('experience_date_range').value = dateRange;
                    document.getElementById('experience_description').value = description;
                } else if (target === 'contactModal') {
                    document.getElementById('contact_id').value = id;
                    document.getElementById('contact_type').value = content;
                    document.getElementById('contact_link').value = link;
                }
            });
        });
    </script>
</body>
</html>
