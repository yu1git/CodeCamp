<?php
// じゃんけん勝負

$player_hand = '';
$computer_hand = '';
$result = '';

if (isset($_POST['rock_scissors_paper']) === TRUE) {
    $player_hand = htmlspecialchars($_POST['rock_scissors_paper'], ENT_QUOTES, 'UTF-8');
}

$computer_rock_scissors_paper = ['グー', 'チョキ', 'パー'];
// array_rand — 配列から一つ以上のキーをランダムに取得する
$computer_hand_key = array_rand($computer_rock_scissors_paper, 1);
$computer_hand = $computer_rock_scissors_paper[$computer_hand_key];

// 質問：プレイヤーの勝ちの条件式をもう少し短くできないのか？
if ( $player_hand === $computer_hand ) {
    // あいこ
    $result = 'Draw';
} else if ( ($player_hand === 'グー' && $computer_hand === 'チョキ') || ($player_hand === 'チョキ' && $computer_hand === 'パー') || ($player_hand === 'パー' && $computer_hand === 'グー')) {
    // プレイヤーの勝ち
    $result = 'Win';
} else {
    // プレイヤーの負け
    $result = 'Lose';
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>課題</title>
</head>
<body>
<?php if (!empty($player_hand)) { ?>
   <p>自分：<?php print $player_hand; ?></p>
   <p>相手：<?php print $computer_hand; ?></p>
   <p>結果：<?php print $result; ?></p>
<?php } ?>
    <form method="post">
        
        <input type="radio" name="rock_scissors_paper" id="rock" value="グー">
        <label for="rock">グー</label>
        <input type="radio" name="rock_scissors_paper" id="scissors" value="チョキ">
        <label for="scissors">チョキ</label>
        <input type="radio" name="rock_scissors_paper" id="paper" value="パー">
        <label for="paper">パー</label>
        
        <input type="submit" value="送信する">
    </form>
</body>
</html>