<?php
// 変数初期化
$gender = '';
if (isset($_POST['gender']) === TRUE) {
   $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>スーパーグローバル変数使用例</title>
</head>
<body>
   <h2>性別を選択してください</h2>
<?php if ($gender === '男' || $gender === '女') { ?>
   <p>あなたの性別は「<?php print $gender; ?>」です</p>
<?php } ?>
   <form method="post">
         <!-- valueに指定した値を送信 -->
         <!-- ラジオボタン -->    
         <input type="radio" name="gender" value="男" <?php if ($gender === '男') { print 'checked'; } ?>>男
         <input type="radio" name="gender" value="女" <?php if ($gender === '女') { print 'checked'; } ?>>女
         
         <!-- チェックボックス -->
         <input type="checkbox" name="example" value="sample">サンプル
         
         <!-- セレクトボックス(value指定あり) -->
         <select name="born_year">
               <option value="2013">2013年</option>
         </select>
         
         <!-- セレクトボックスはvalueを指定しなかった場合、表示されている値が送信される -->
         <!-- セレクトボックス(value指定なし) -->
         <select name="born_year">
               <option>2013年</option>
         </select>
         
         <input type="submit" value="送信">
      </form>
</body>
</html>