$(function() {
	setModal();
});
 
function setModal() {

	//HTML読み込み時にモーダルウィンドウの位置をセンターに調整
	adjustCenter("div#modal div.container");
 
	//ウィンドウリサイズ時にモーダルウィンドウの位置をセンターに調整
	$(window).resize(function() {
		adjustCenter("div#modal div.container");
	});
 
	//背景がクリックされた時にモーダルウィンドウを閉じる
	$("div#modal div.background").click(function() {
		displayModal(false);
	});
 
	//クリックされた時にAjaxでコンテンツを読み込む
	$("input.btn-primary").click(function() {
		// var str1 = document.tree.tweetID.value;
		// $("div#modal div.container").load($(this).attr("type"), data="php", onComplete());
		$("div#modal div.container").load('modal.php', {
			tweetID: 466799125611028481
			}
			,onComplete());
		console.log("aaaaa");
		return false;
	});
}

//コンテンツの読み込み完了時にモーダルウィンドウを開く
function onComplete() {
	displayModal(true);
	$("div#modal div.container a.close").click(function() {
		displayModal(false);
		return false;
	});
}

//モーダルウィンドウを開く
function displayModal(sign) {
	if (sign) {
		$("div#modal").fadeIn(500);
	} else {
		$("div#modal").fadeOut(250);
	}
}
 
//ウィンドウの位置をセンターに調整
function adjustCenter(target) {
	var margin_top = ($(window).height()-$(target).height())/2;
	var margin_left = ($(window).width()-$(target).width())/2;
	$(target).css({top:margin_top+"px", left:margin_left+"px"});
}