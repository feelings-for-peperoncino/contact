<?php
session_start();

if (!isset($_SESSION['form'])) {
  header('Location: contact.php');
  exit();
} else {
  $post = $_SESSION['form'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $to = 'メールアドレス@example.com';
  $from = $post['email'];
  $subject = 'お問い合わせが届きました';
  $body = <<<EOT
名前: {$post['name']}
メールアドレス: {$post['email']}
内容:
{$post['contact']}
EOT;
  mb_send_mail($to, $subject, $body, "From: {$form}");
  unset($_SESSION['form']);
  header('Location: complete.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="POST">
    <p>確認画面</p>
    <p>お名前</p>
    <p><?php echo htmlspecialchars($post['name']) ?></p>
    <p>メールアドレス</p>
    <p><?php echo htmlspecialchars($post['email']) ?></p>
    <p>お問い合わせ内容</p>
    <p><?php echo nl2br(htmlspecialchars($post['contact'])) ?></p>
    <div>
      <a href="contact.php">戻る</a>
    </div>
    <button type="submit">送信する</button>
  </form>
</body>

</html>