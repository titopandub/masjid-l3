$(function () {
	$.fn.serializeObject = function() {
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name]) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};

	$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
	{
		if ( typeof sNewSource != 'undefined' && sNewSource != null ) {
			oSettings.sAjaxSource = sNewSource;
		}

		// Server-side processing should just call fnDraw
		if ( oSettings.oFeatures.bServerSide ) {
			this.fnDraw();
			return;
		}

		this.oApi._fnProcessingDisplay( oSettings, true );
		var that = this;
		var iStart = oSettings._iDisplayStart;
		var aData = [];

		this.oApi._fnServerParams( oSettings, aData );

		oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
			/* Clear the old information from the table */
			that.oApi._fnClearTable( oSettings );

			/* Got the data - add it to the table */
			var aData =  (oSettings.sAjaxDataProp !== "") ?
			that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;

			for ( var i=0 ; i<aData.length ; i++ ) {
				that.oApi._fnAddData( oSettings, aData[i] );
			}

			oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

			if ( typeof bStandingRedraw != 'undefined' && bStandingRedraw === true ) {
				oSettings._iDisplayStart = iStart;
				that.fnDraw( false );
			} else {
				that.fnDraw();
			}

			that.oApi._fnProcessingDisplay( oSettings, false );

			/* Callback user function - for event handlers etc */
			if ( typeof fnCallback == 'function' && fnCallback != null ) {
				fnCallback( oSettings );
			}
		}, oSettings );
	};

	$.fn.clearForm = function() {
		return this.each(function() {
			var type = this.type, tag = this.tagName.toLowerCase();
			if (tag == 'form')
				return $(':input',this).clearForm();
			if (type == 'text' || type == 'password' || tag == 'textarea')
				this.value = '';
			else if (type == 'checkbox' || type == 'radio')
				this.checked = false;
			else if (tag == 'select')
				this.selectedIndex = -1;
		});
	};
});

var mesjid = {
	dateFormat : function (date) {
		var parsedDate = Date.parse(date).toString('yyyy-MM-d');
		return parsedDate;
	}
};