/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowserUrl='public/ckeditor/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl='public/ckeditor/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = 'public/ckeditor/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = 'public/ckeditor/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = 'public/ckeditor/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = 'public/ckeditor/upload.php?type=flash';
};
