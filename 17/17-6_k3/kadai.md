# 要件
+ ◯郵便番号及び住所の情報をデータベースで管理する。
+ ◯郵便番号から住所が検索できる。
+ ◯検索結果は一覧で「郵便番号、住所」の最低限2つを1行ずつ表示する。
+ ◯郵便番号が未入力だった場合、エラーメッセージを表示する。
+ ◯郵便番号は7桁の数値のみ検索可能とし、それ以外はエラーメッセージを表示する。
+ ◯都道府県と市区町村から住所が検索できる。
+ ◯都道府県、市区町村のどちらか又は両方が未入力だった場合、エラーメッセージを表示する※どちらか片方だけの検索禁止
+ ◯郵便番号、都道府県、市区町村の入力の前後にある全角及び半角スペースを削除する。入力値チェックや検索はこの後に行う。 例)「 1100001　」→「1100001」
+ ◯検索結果が10件を超えた場合、表示結果を複数ページに分ける。 ※「前へ」「次へ」のようなリンクによりページ切り替えができる

▼調べる
formが２つ必要→区別の仕方は？→済
    https://teratail.com/questions/318167 
        <input type="hidden" name="search_method" value="zipcode">のvalueで判別する

入力の前後にある全角及び半角スペースを削除？→済　確認未
    07/7-8_k2/practice_global_receive_elementary.php　と同じで問題ない？

ページ切り替え？
    https://お役立ち.xyz/php/pagination-switching/7187/

▼テーブル作成
%%テーブル作成などを行わず、CSVファイルをそのままインポート%%
zip_data_split_1.sqlをインポート

▼問題
◯検索結果が元のページに戻って表示されない→actionを修正includeを追加
ページ切り替えができない
    SQLでlimitを使用し、毎回取得する→「次へ」リンクで再度検索が必要

    http://localhost/CodeCamp/17/17-6_k3/practice_post_code_advanced.php?page=2
    
    ▼対応
    ページ以外の情報が送られていない
    リンクではformのpost送信はできない。getの方式では送れる
    必要な情報をgetで送ってあげる
    都道府県・住所の情報・どちらの検索をしているかのフラグ

    postの場合、検索結果のページをURLで共有することができない
    postをつかって隠す必要があるのか？→ない
    →post使うメリットはなく、getを使うメリットはある

    全部取得してしまうとページに10件しか表示しないのに負荷が大きくなることも
    →10件