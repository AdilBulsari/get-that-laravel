<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">
                        Category <Button @click="addModal = true"> <Icon type="md-add" />Add Category</Button>
                    </p>

                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            <tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
                                <td>{{ tag.id }}</td>
                                <td class="_table_name">{{ tag.tagName }}</td>
                                <td>{{ tag.updated_at }}</td>
                                <td>
                                    <Button type="info" @click="showEditModal(tag, i)" size="small">Edit</Button>
                                    <Button type="error" @click="deleteTag(tag, i)" :loading="tag.isDeleting" size="small">Delete</Button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- tag adding model -->
                <Modal v-model="addModal" :mask-closable="false" title="Add Category">
                    <Input v-model="data.tagName" placeholder="Add Add Category name" />
                    <div style="margin-bottom: 10px"></div>
                    <Upload
                        :on-success="handleSuccess"
                 :on-exceed-size="handleMaxSize"
                 :on-error="handleError"
                        :max-size="2048"
                       
                        :headers="{ 'x-csrf-token': token ,'X-requested-with':'XMLHttpRequest'}"
                        type="drag"
                        action="/app/upload"
                    >
                        <div style="padding: 20px 0">
                            <Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon>
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>

                    <template #footer>
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" :disabled="isAdding" :loading="isAdding" @click="addTag">{{ isAdding ? 'Adding...' : 'Add Tag' }}</Button>
                    </template>
                </Modal>
                <!-- edit modal -->
                <Modal v-model="editModal" :mask-closable="false" title="Edit Tag">
                    <Input v-model="editData.tagName" placeholder="Edit tag name" />

                    <template #footer>
                        <Button type="default" @click="editModal = false">Close</Button>
                        <Button type="primary" :disabled="isAdding" :loading="isAdding" @click="editTag">{{ isAdding ? 'Editing...' : 'Edit Tag' }}</Button>
                    </template>
                </Modal>
            </div>
        </div>
    </div>
</template>

<script>
import '../../components/common';
export default {
    data() {
        return {
            data: {
                iconImage: '',
                categoryName:''
            },
            editData: {
                tagName: '',
            },
            addModal: false,
            isAdding: false,
            editModal: false,
            tags: [],
            index: '',
            token: '',
        };
    },
    methods: {
        handleSuccess (res, file) {
                this.data.iconImage = res.image
            },
            handleError (res, file) {
              console.log(res,'res')
              console.log(file,'file')
            },
            handleFormatError (file) {
                this.$Notice.warning({
                    title: 'The file format is incorrect',
                    desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
                });
            },
            handleMaxSize (file) {
                this.$Notice.warning({
                    title: 'Exceeding file size limit',
                    desc: 'File  ' + file.name + ' is too large, no more than 2M.'
                });
            },
        async addTag() {
            this.isAdding = true;

            const res = await this.callApi('post', 'app/create_tag', this.data);
            if (res.status === 201) {
                this.tags.unshift(res.data);
                this.isAdding = false;
                this.data.tagName = '';
                this.success('Done', 'Tag name is added');
                this.addModal = false;
            } else {
                if (res.status == 422) {
                    if (res.data.errors.tagName) this.error('Oops', res.data.errors.tagName[0]);
                } else {
                    this.warning('Oops', 'Something went wrong');
                }
                this.isAdding = false;
            }
        },
        async deleteTag(tag, i) {
            if (!confirm('Are you sure you want to delete this tag ?')) return;
            tag.isDeleting = true;

            const res = await this.callApi('delete', 'app/delete_tag', tag);
            if ((res.status = 200)) {
                this.tags.splice(i, 1);
                this.success('Success', 'Tag has been deleted successfully !');
            } else {
                this.warning('Oops', 'Something went wrong');
            }
        },
        async editTag() {
            this.isAdding = true;

            const res = await this.callApi('patch', 'app/edit_tag', this.editData);
            if (res.status === 200 || res.statusText == 'ok') {
                this.tags[this.index].tagName = this.editData.tagName;
                this.isAdding = false;
                this.data.tagName = '';
                this.success('Done', 'Tag name is updated');
                this.editModal = false;
            } else {
                if (res.status == 422) {
                    if (res.data.errors.tagName) this.error('Oops', res.data.errors.tagName[0]);
                } else {
                    this.warning('Oops', 'Something went wrong');
                }
                this.isAdding = false;
            }
        },
        showEditModal(tag, i) {
            let editedData = {
                id: tag.id,
                tagName: tag.tagName,
            };
            this.editData = editedData;
            this.editModal = true;
            this.index = i;
        },
    },
    async created() {
        this.token = window.laravel.csrfToken;
        const res = await this.callApi('get', 'app/get_tags', this.data);
        console.log(res);
        if (res.status === 200 || res.statusText == 'OK') {
            this.tags = res.data;
            console.log(this.tags);
        } else {
            this.error('oops', 'something went wrong !!');
        }
        console.log(this.token);
    },
};
</script>
