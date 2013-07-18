
var FormsErrors = Class.create();

FormsErrors.prototype = {

    initialize: function() {
      this.ErrorsList = {};
    },

    addError: function(elem_id, msg)
    {
      this.ErrorsList[elem_id] = msg;
    },

    displayErrors: function()
    {
      for(id in this.ErrorsList) {
        var err_elem = $('errmsg_'+id);
        if (err_elem) {
          err_elem.innerHTML = '<div class="lb"><div class="error_rt"><div class="rb"><div class="error_block" >'+this.ErrorsList[id]+'</div></div></div></div>';
//        $(id).firstChild.firstChild.firstChild.firstChild.innerHTML = this.ErrorsList[id];
          err_elem.style.display = 'block';
        }
      }
    }
}

FormErrors = new FormsErrors();