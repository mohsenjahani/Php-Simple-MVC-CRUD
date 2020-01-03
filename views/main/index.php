<post-modal v-on:post-modal-confirm="postModalConfirm"></post-modal>

<div id="loading" class="loading"></div>

<button class="btn btn-primary" @click="showModalAdd()">Add Post</button>

<table class="table mt-3">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(item, index) in posts">
        <th scope="row">{{ index+1 }}</th>
        <td> {{ item.title }} </td>
        <td>
            <button @click="editItem(item.id)" class="btn btn-info">Edit</button>
            <button @click="deleteItem(item.id)" class="btn btn-danger">Delete</button>
        </td>
    </tr>
    </tbody>
</table>
