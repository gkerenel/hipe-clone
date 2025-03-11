<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberNet - The Hacker's Social Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Share Tech Mono', monospace;
            background-color: #0d0d0d;
            color: #00ff00;
            margin: 0;
            padding: 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background-color: #111;
            border-bottom: 3px solid #00ff00;
        }
        .navbar a {
            color: #00ff00;
            text-decoration: none;
            padding: 10px;
        }
        .hero {
            text-align: center;
            padding: 80px 20px;
            background-image: url('https://source.unsplash.com/1600x900/?matrix,code');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
        }
        .hero h1 {
            font-size: 50px;
            text-shadow: 0 0 10px #00ff00;
        }
        .hero p {
            font-size: 20px;
        }
        .features, .about, .cta {
            padding: 50px 20px;
            border-radius: 20px;
            background-color: #222;
            margin: 20px;
        }
        .features h2, .about h2, .cta h2 {
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #111;
            border-top: 3px solid #00ff00;
        }
        .button {
            background-color: #00ff00;
            color: #0d0d0d;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 10px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <div class="logo">CyberNet</div>
    <div>
        <a href="#features">Features</a>
        <a href="#about">About</a>
        <a href="#cta">Join Now</a>
    </div>
</nav>
<section class="hero">
    <h1>Welcome to CyberNet</h1>
    <p>The Ultimate Social Hub for Hackers, Coders, and Tech Enthusiasts.</p>
    <a href="#cta" class="button">Join the Network</a>
</section>
<section id="features" class="features">
    <h2>Features</h2>
    <ul>
        <li>Create an Account</li>
        <li>Post Your Thoughts</li>
        <li>Comment on Posts</li>
        <li>Follow Other Tech Enthusiasts</li>
    </ul>
</section>
<section id="about" class="about">
    <h2>About CyberNet</h2>
    <p>CyberNet is the ultimate social platform designed for programmers, ethical hackers, and digital explorers. Connect, share knowledge, and engage in deep tech discussions. Our network is built with privacy, security, and innovation in mind.</p>
</section>
<section id="cta" class="cta">
    <h2>Join the Cyber Revolution</h2>
    <p>Be part of the elite. Connect with fellow coders, share your ideas, and stay ahead in the world of technology.</p>
    <a href="#" class="button">Sign Up Now</a>
</section>
<footer class="footer">
    <p>&copy; 2025 CyberNet. All Rights Reserved.</p>
</footer>
</body>
</html>
