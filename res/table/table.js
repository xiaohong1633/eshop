/*
    Edit by zsk on 2015-07-01
    change Style to AmazeUI
*/
$.extend({
  table: function (id, title, headData, field, data) {
    this.$wrapper = $(id);
    this.$wrapper.addClass('widget_table');
    this.title = title;
    this.headData = headData;
    this.field = field;
    //this.data = $.parseJSON(data);
	this.data=data;
    this.currentPage = 1;
    this.pageSize = 5;
    //console.log("here");
    //生成框架
    this.$head = $('<div class="am-text-lg am-text-primary am-text-center" />').appendTo(this.$wrapper);
    this.$content = $('<div />').appendTo(this.$wrapper);
    this.$footer = $('<div class="am-cf" />').appendTo(this.$wrapper);
    this.$table = $('<table class="am-table am-table-striped am-table-hover am-table-bordered am-table-radius" />').appendTo(this.$content);
    this.$thead = $('<thead />').appendTo(this.$table);
    this.$theadTr = $("<tr />").appendTo(this.$thead);
    this.$tbody = $('<tbody />').appendTo(this.$table);
    //console.log(this.$footer);
    this.setTitle = function (title) {
      this.title = title;
    }
    this.displayTitle = function () {
      this.$head.empty();
      $('<h2>' + this.title + '</h2>').appendTo(this.$head);
    }
    //生成表格头

    this.displayHead = function () {
        this.$theadTr.empty();
      for (var i = 0; i < this.headData.length; i++) {
          $('<th>' + this.headData[i] + '</th>').appendTo(this.$theadTr);
      }
    }
    //this.displayHead();

    this.displayBody = function () {
      this.$tbody.empty();
      var begin = this.pageSize * (this.currentPage - 1);
      var temp = this.pageSize * this.currentPage;
      var end = (temp > this.data.length) ? this.data.lenth : temp;
      var displayData = this.data.slice(begin, end);
      //console.log(displayData);
      for (var i = 0; i < displayData.length; i++) {
        var $tr = $('<tr />').appendTo(this.$tbody);
        for (var j = 0; j < this.field.length; j++) {
            $('<td>' + displayData[i][this.field[j]] + '</td>').appendTo($tr);
            //console.log(this.field[j]);
        }
      }
      for (var i = 0; i < this.pageSize - displayData.length; i++) {
        var $tr = $('<tr/>');
        for (var j = 0; j < this.field.length; j++) {
          $('<td>&nbsp</td>').appendTo($tr);
        }
        $tr.appendTo(this.$tbody);
      }
    }
    //this.displayBody();

    this.displayFooter = function () {
      this.$footer.empty();
      var $pageDiv = $('<span>每页显示</span>').appendTo(this.$footer);
      var $pageNum = $('<select name="table_pageNum" id="table_pageNum"></select>').appendTo($pageDiv);
      for (var i = 5; i <= 50; i += 5) {
		  if(i==this.pageSize){
			  $("<option selected='selected'>"+i+"</option>").appendTo($pageNum);
		  }else{
			$('<option>' + i + '</option>').appendTo($pageNum);
		  }
      }
      $('<span>条</span>').appendTo($pageDiv);
      $('<a id="table_first" href="#"><span class="am-icon-fast-backward am-margin-left"></span></a>').appendTo(this.$footer);
      $('<a id="table_before" href="#"><span class="am-icon-backward am-margin-left"></span></a>').appendTo(this.$footer);
     
      var se = '<span class="am-margin-left">当前为第<select name="currentPage">';
      for (var i = 1; i <= Math.ceil(this.data.length / this.pageSize); i++) {
        if (this.currentPage == i) {
          se += '<option selected="selected">' + i + '</option>';
        } else {
          se += '<option>' + i + '</option>';
        }
      }
      se += '</select>页  共 <strong>' + Math.ceil(this.data.length / this.pageSize) + '</strong> 页</div>';
      $(se).appendTo(this.$footer);
      $('<a id="table_next" href="#"><span class="am-icon-forward am-margin-left"></span></a>').appendTo(this.$footer);
      $('<a id="table_last" href="#"><span class="am-icon-fast-forward am-margin-left"></span></a>').appendTo(this.$footer);

    }
    //this.displayFooter();

    this.updateData = function (data) {
      this.data = $.parseJSON(data);
    }
    this.display = function () {
        //console.log("display");
      this.displayTitle();
      this.displayHead();
      this.displayBody();
      this.displayFooter();
    }
    this.addColumn = function (index, colName, fieldName) {
      //列数字已0开头，列名字，列数据在data中的field
      //console.log(this.headData);
      for (var i = this.headData.length; i > index; i--) {
        this.headData[i] = this.headData[i - 1];
        this.field[i] = this.field[i - 1];
      }
      this.field[index] = fieldName;
      this.headData[index] = colName;
      //console.log(this.headData);
    }
    this.fillColumn = function (colName, fillData) {
      //此处目前只是处理字符串，还不能处理数组
      //console.log(this.data);
      for (var i = 0; i < this.data.length; i++) {
        this.data[i][colName] = fillData;
      }
      //console.log(this.data);

    }
	  $('body').off('click', '#table_first').on('click', '#table_first', {
        obj: this
      }, function (e) {
        var obj = e.data.obj;
        obj.currentPage = 1;
        obj.display();
      });
      $('body').off('click', '#table_before').on('click', '#table_before', {
        obj: this
      }, function (e) {
        var obj = e.data.obj;
        if (obj.currentPage != 1) {
          obj.currentPage -= 1;
        } else {
            var d = dialog({
                title: "提示",
                content:"已经是第一页了"
            })
            d.show();
          //alert('已经是第一页了');
        }
        obj.display();
      });
      $('body').off('click', '#table_next').on('click', '#table_next', {
        obj: this
      }, function (e) {
        var obj = e.data.obj;
        if (obj.currentPage != Math.ceil(obj.data.length / obj.pageSize)) {
          obj.currentPage += 1;
        } else {
            var d = dialog({
                title: "提示",
                content: "已经是最后一页了"
            })
            d.show();
        }
        obj.display();
      });
      $('body').off('click', '#table_last').on('click', '#table_last', {
        obj: this
      }, function (e) {
        var obj = e.data.obj;
        obj.currentPage = Math.ceil(obj.data.length / obj.pageSize);
        obj.display();
      });
	  $("body").off("change","#table_pageNum").on("change","#table_pageNum",{obj:this},function(e){
		  //alert('hi');
		  var obj=e.data.obj;
		  obj.pageSize=$(this).val();
		  obj.currentPage=1;
		  obj.display();
	  });
    return this;
  }
});
