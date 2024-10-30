(function () {
	function ShowSelection()
	{
		var selectedText = tinyMCE.activeEditor.selection.getContent( {format : "text"} );
		return selectedText;
	}
	tinymce.create('tinymce.plugins.ctt', {
		init: function (ed, url) {
			ed.addButton('ctt', {
				title: 'Click To Tweet WordPress Plugin',
				image: url.replace("/js", "") + '/images/editor-ticon.png',
				onclick: function () {
					var seltxt =  ShowSelection();
					var pre_txt =  encodeURIComponent(seltxt).replace("%A0", "%20");
					var permalink = jQuery('#sample-permalink a').attr('href');
					jQuery(document).ready(function ($) {
						tinymce.activeEditor.windowManager.open({
							title: "Click To Tweet WordPress Plugin",
							width: 1030,
							height: 600,
							classes: 'myAwesomeClass-panel',
							url: ajaxurl + '?action=ctt_show_dialog&pretext='+pre_txt+'&permalink='+permalink,
						});
					});
				}
			});
		},
		createControl: function (n, cm) {
			return null;
		},
		getInfo: function () {
			return {
				longname: "Click To Tweet WordPress Plugin",
				author: 'ClickToTweet.com',
				authorurl: 'http://ctt.ec/',
				infourl: 'http://ctt.ec/',
				version: "2.0.10"
			};
		}
	});
	tinymce.PluginManager.add('ctt', tinymce.plugins.ctt);
})();
