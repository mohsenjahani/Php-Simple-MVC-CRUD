
new Vue({
    el: '#main',
    data: {
        posts: [],
    },
    created: function(){
        this.updateList();
    },
    methods: {
        request(url, jsonBody, callback) {
            $.ajax({
                url: url,
                type: "POST",
                data: JSON.stringify(jsonBody),
                contentType: "application/json; charset=utf-8",
                dataType   : "json",
                cache: false,
                success: function (response) {
                    if(response.ok){
                        if(response.hasOwnProperty("msg"))
                            callback(response.data, response.msg);
                        else
                            callback(response.data);
                    }else{
                        if(response.hasOwnProperty("msg"))
                            alert(response.msg);
                        else
                            alert("Response is not ok!")
                    }
                },
                error: function (e) {
                    alert('Please try again!');
                }
            });
        },

        updateList(){
            var v = this;
            this.request('api/getAll', null, function (data) {
                v.posts = data;
                v.loading(false);
            })
        },

        /**
         * Delete post
         * @param id
         */
        deleteItem(id) {
            var v = this;
            if (confirm("Are you sure?")) {
                this.loading(true);
                this.request("api/delete/"+id, null, function (data, msg) {
                    //alert(msg);
                    v.updateList();
                });
            }
        },

        /**
         * Edit post
         * @param id
         */
        editItem(id) {
            var v = this;
            this.loading(true);
            this.request("api/get/"+id, null, function (data) {
                v.$root.$emit('post-modal-set', {
                    type: "edit",
                    id: data.id,
                    title: data.title,
                    text: data.text,
                });
                $('#modalPost').modal('show');
                v.loading(false);
            });

        },

        showModalAdd(){
            this.$root.$emit('post-modal-set', {
                type: "add",
                id: "",
                title: "",
                text: "",
            });

            $('#modalPost').modal('show');
        },


        /**
         * Modal confirm button
         * @param data
         */
        postModalConfirm(data){
            this.log(data);
            var v = this;
            if(data.type==='add'){
                this.request("api/add", {
                    title: data.title,
                    text: data.text,
                }, function (data) {
                    $('#modalPost').modal('hide');
                    v.updateList();
                })
            } else { // type is edit
                this.request("api/update", {
                    id: data.id,
                    title: data.title,
                    text: data.text,
                }, function (data) {
                    $('#modalPost').modal('hide');
                    v.updateList();
                })
            }
        },


        /**
         * Showing loading
         * @param show
         */
        loading(show){
            if(show){
                $('#loading').fadeIn();
            }else{
                $('#loading').fadeOut();
            }
        },

        /**
         * Log in console
         * @param data
         */
        log(data) {
            console.log(data);
        },

    }
});