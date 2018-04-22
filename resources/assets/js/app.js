
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if ( $(".basicForm").length > 0 ) 
{

	const BasicForm = new Vue({
		el: '.basicForm',
		components: {
			basicForm: require('./components/BasicForm.vue')
		}
	});

};

if ( $(".basicList").length > 0 ) 
{

	const BasicList = new Vue({
		el: '.basicList',
		components: {
			basicList: require('./components/BasicList.vue')
		}
	});

};

if ( $(".shopList").length > 0 ) 
{

	const shopList = new Vue({
		el: '.shopList',
		components: {
			shopList: require('./components/shopList.vue'),
			mallProductLightbox: require('./components/mallProductLightbox.vue'),
		}
	});

};