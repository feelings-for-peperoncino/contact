<?php
session_start();
$error = []; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  if ($post['name'] === '') {
    $error['name'] = 'blank';
  }
  if ($post['email'] === '') {
    $error['email'] = 'blank';
  } 
  if ($post['contact'] === '') {
    $error['contact'] = 'blank';
  }

  if (count($error) === 0) {
    $_SESSION['form'] = $post;
    header('Location: confirm.php');
    exit();
  }
} else {
  if (isset($_SESSION['form'])) {
    $post = $_SESSION['form'];
  }
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
  <div class="container">
    <form action="" method="POST" novalidate>
      <h2>お問い合わせ</h2>
      <div>
        <div>
          <label for="inputName">お名前</label>
        </div>
        <div>
          <input type="text" name="name" id="inputName" value="<?php echo htmlspecialchars($post['name']) ?>" required autofocus>
        </div>
        <?php if ($error['name'] === 'blank') : ?>
          <p>※お名前をご記入下さい</p>
        <?php endif; ?>
      </div>
      <div>
        <div>
          <label for="inputEmail">メールアドレス</label>
        </div>
        <div>
          <input type="text" name="email" id="inputEmail" value="<?php echo htmlspecialchars($post['email']) ?>" required>
        </div>
        <?php if ($error['name'] === 'blank') : ?>
          <p>※メールアドレスをご記入下さい</p>
        <?php endif; ?>
        <?php if ($error['email'] === 'email') : ?>
          <p class="error_msg">※メールアドレスを正しくご記入下さい</p>
        <?php endif; ?>
      </div>
      <div>
        <div>
          <label for="inputContent">お問い合わせ内容</label>
        </div>
        <div>
          <textarea type="text" name="contact" id="inputContent" value="" rows="10" required><?php echo htmlspecialchars($post['contact']) ?></textarea>
          <?php if ($error['name'] === 'blank') : ?>
            <p>※内容をご記入下さい</p>
          <?php endif; ?>
        </div>
      </div>
      <div>
        <button type="submit">確認画面へ</button>
      </div>
    </form>
  </div>

</body>

</html>