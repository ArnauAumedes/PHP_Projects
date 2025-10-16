<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="field">
                <label for="name">
                    <i class="fas fa-user"></i> Your Name
                </label>
                <input type="text" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
            </div>
            <div class="field">
                <label for="email">
                    <i class="fas fa-envelope"></i> Your Email
                </label>
                <input type="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
                <span class="error">* <?php echo $emailErr; ?></span>
            </div>
            <div class="field">
                <label for="message">
                    <i class="fas fa-comment"></i> Message
                </label>
                <textarea name="message" rows="5" cols="40"
                    placeholder="Enter your message"><?php echo $message; ?></textarea>
                <span class="error"><?php echo $messageErr; ?></span>
            </div>
            <button type="submit" name="submit">Submit</button>
    </div>
    </form>
</body>

</html>