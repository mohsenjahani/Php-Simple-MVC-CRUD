Vue.component('post-modal', {
    data: function () {
        return {
            type: "add",
            id: "",
            title: "",
            text: "",
        }
    },
    mounted() {
        var v = this;
        this.$root.$on('post-modal-set', (data) => {
            console.log(data);
            v.type = data.type;
            v.id = data.id;
            v.title = data.title;
            v.text = data.text;
            $("#post-modal-loading").hide();
        });
    },
    methods: {
        confirm(){
            this.$emit('post-modal-confirm', {
                type: this.type,
                id: this.id,
                title: this.title,
                text: this.text,
            });
            $("#post-modal-loading").fadeIn();
        }
    },
    template: ` 
<div class="modal fade" id="modalPost" tabindex="-1" role="dialog" aria-labelledby="modalPostTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"> 
            <div id="post-modal-loading" class="modal-loading"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="modalPostTitle">{{ type==='add'?'Add Post':'Edit Post' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="postFormAdd">
                    <div class="form-group">
                        <label for="titleInput1">Title</label>
                        <input v-model="title" name="title" maxlength="50" id="titleInput1" type="text" class="form-control" placeholder="Enter something..">
                    </div>
                    <div class="form-group">
                        <label for="contentTextarea1">Content</label>
                        <textarea v-model="text" name="text" class="form-control" id="contentTextarea1" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button @click="confirm()" type="button" class="btn btn-primary">{{ type==='add'?'Add':'Save' }}</button>
            </div>
        </div>
    </div>
</div>
`
});