<!DOCTYPE html>
<html lang="ja">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>郵便番号検索</title>
    <style>
        .search_reslut {
            border-top: solid 1px;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
        }

        table,
        tr,
        th,
        td {
            border: solid 1px;
        }

        caption {
            text-align: left;
        }
    </style>
    <style type="text/css">
        @font-face {
            font-family: Roboto;
            src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf");
        }
    </style>
    <link rel="stylesheet" href="chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/xq-light.css">
    <link rel="stylesheet" href="chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/dracula.css">
    <link rel="stylesheet" href="chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/codemirror.css">
</head>

<body>
    <section class="blackbox-overlay">

        <div data-current="Tab 1" data-easing="ease" data-duration-in="300" data-duration-out="100"
            class="tabs-2 w-tabs">
            <div class="confirmation-modal">
                <div class="small-close on-confirmation-modal w-inline-block">
                    <img src="./郵便番号検索_files/6489f7e3cd2fb16b87351cac_Close.svg" loading="lazy" alt="" class="image-37">
                </div>
            </div>
        </div>
    </section>
    <h1>郵便番号検索</h1>
    <section>
        <h2>郵便番号から検索</h2>
        <form method="post" action="practice_post_code_advanced.php">
            <input type="text" name="zipcode" placeholder="例）1010001" value="">
            <!-- <input type="hidden" name="search_method" value="zipcode"> -->
            <input type="submit" value="検索">
        </form>
        <h2>地名から検索</h2>
        <form>
            都道府県を選択
            <select name="pref">
                <option value="" selected="">都道府県を選択</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                <option value="岩手県">岩手県</option>
                <option value="宮城県">宮城県</option>
                <option value="秋田県">秋田県</option>
                <option value="山形県">山形県</option>
                <option value="福島県">福島県</option>
                <option value="茨城県">茨城県</option>
                <option value="栃木県">栃木県</option>
                <option value="群馬県">群馬県</option>
                <option value="埼玉県">埼玉県</option>
                <option value="千葉県">千葉県</option>
                <option value="東京都">東京都</option>
                <option value="神奈川県">神奈川県</option>
                <option value="新潟県">新潟県</option>
                <option value="富山県">富山県</option>
                <option value="石川県">石川県</option>
                <option value="福井県">福井県</option>
                <option value="山梨県">山梨県</option>
                <option value="長野県">長野県</option>
                <option value="岐阜県">岐阜県</option>
                <option value="静岡県">静岡県</option>
                <option value="愛知県">愛知県</option>
                <option value="三重県">三重県</option>
                <option value="滋賀県">滋賀県</option>
                <option value="京都府">京都府</option>
                <option value="大阪府">大阪府</option>
                <option value="兵庫県">兵庫県</option>
                <option value="奈良県">奈良県</option>
                <option value="和歌山県">和歌山県</option>
                <option value="鳥取県">鳥取県</option>
                <option value="島根県">島根県</option>
                <option value="岡山県">岡山県</option>
                <option value="広島県">広島県</option>
                <option value="山口県">山口県</option>
                <option value="徳島県">徳島県</option>
                <option value="香川県">香川県</option>
                <option value="愛媛県">愛媛県</option>
                <option value="高知県">高知県</option>
                <option value="福岡県">福岡県</option>
                <option value="佐賀県">佐賀県</option>
                <option value="長崎県">長崎県</option>
                <option value="熊本県">熊本県</option>
                <option value="大分県">大分県</option>
                <option value="宮崎県">宮崎県</option>
                <option value="鹿児島県">鹿児島県</option>
                <option value="沖縄県">沖縄県</option>
            </select>
            市区町村
            <input type="text" name="address" value="">
            <input type="hidden" name="search_method" value="address">
            <input type="submit" value="検索">
        </form>
    </section>
    <section class="search_reslut">
        <p>ここに検索結果が表示されます</p>
    </section>
</body>

</html>