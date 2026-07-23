<?php

include("config/database.php");

$message = "";

if (isset($_POST['send']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $msg = $_POST['message'];

    $stmt = mysqli_prepare($conn, "
    INSERT INTO contact_messages
    (name,email,subject,message)
    VALUES(?,?,?,?)");

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $email,
        $subject,
        $msg
    );

    if (mysqli_stmt_execute($stmt))
    {
        $message = "<div class='alert-box success'>Message sent successfully. We'll get back to you soon.</div>";
    }
    else
    {
        $message = "<div class='alert-box danger'>".mysqli_stmt_error($stmt)."</div>";
    }
}

include("includes/navbar.php");

?>

<section class="page-hero">
<div class="container">
<span class="eyebrow reveal">Get in touch</span>
<h1 class="reveal">We'd love to hear from you</h1>
<p class="reveal">Questions about placements, partnerships, or your account? Send us a message.</p>
</div>
</section>

<section class="section" style="padding-top:32px;">
<div class="container">

<div class="contact-grid">

<div class="contact-info-card reveal">

<div class="row-item">
<i class="bi bi-envelope"></i>
<div>
<h5>Email</h5>
<p>support@careerconnect.example</p>
</div>
</div>

<div class="row-item">
<i class="bi bi-telephone"></i>
<div>
<h5>Phone</h5>
<p>Mon–Fri, 9am–6pm</p>
</div>
</div>

<div class="row-item">
<i class="bi bi-geo-alt"></i>
<div>
<h5>Placement Office</h5>
<p>Campus placement cell, main block</p>
</div>
</div>

<div class="row-item">
<i class="bi bi-clock-history"></i>
<div>
<h5>Response Time</h5>
<p>We usually reply within 1–2 business days</p>
</div>
</div>

</div>

<div class="panel reveal reveal-delay-1">

<?php echo $message; ?>

<form method="POST">

<div class="form-field">
<label>Your Name</label>
<input type="text" name="name" placeholder="Jane Doe" required>
</div>

<div class="form-field">
<label>Email Address</label>
<input type="email" name="email" placeholder="you@example.com" required>
</div>

<div class="form-field">
<label>Subject</label>
<input type="text" name="subject" placeholder="How can we help?" required>
</div>

<div class="form-field">
<label>Message</label>
<textarea name="message" placeholder="Tell us a bit more..." required></textarea>
</div>

<button type="submit" name="send" class="btn btn-primary btn-lg">
<i class="bi bi-send"></i> Send Message
</button>

</form>

</div>

</div>

</div>
</section>

<?php include("includes/footer.php"); ?>
