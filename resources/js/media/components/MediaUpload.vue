<script setup>
import { ref } from 'vue';
import { useMediaStore } from '../store';

const file = ref(null);
const files = ref([]);

const onFileChange = (e) => {
    const fileList = e.target.files;
    for (let i = 0; i < fileList.length; i++) {
        files.value.push(fileList[i]);
    }
};

const removeFile = (index) => {
    files.value.splice(index, 1);
};

const uploadFile = async () => {
    const formData = new FormData();
    files.value.forEach((file) => {
        formData.append('file[]', file);
    });

    try {
        // console.log(formData.get('file[]'));
        const response = await fetch('/media/upload', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        console.log(response.message);
        if (response.ok) {
            console.log('File uploaded successfully');
        } else {
            console.error('Failed to upload file');
        }
    } catch (error) {
        console.error('Failed to upload file', error);
    }
};

const onDragOver = (e) => {
    e.preventDefault();
};

const onDrop = (e) => {
    e.preventDefault();
    const fileList = e.dataTransfer.files;
    for (let i = 0; i < fileList.length; i++) {
        files.value.push(fileList[i]);
    }
};

const onDragLeave = (e) => {
    e.preventDefault();
    console.log('onDragLeave');
};

const onDragEnter = (e) => {
    e.preventDefault();
    console.log('onDragEnter');
};

const onDragEnd = (e) => {
    e.preventDefault();
    console.log('onDragEnd');
};

const onDragStart = (e) => {
    e.preventDefault();
    console.log('onDragStart');
};

const onDrag = (e) => {
    e.preventDefault();
    console.log('onDrag');
};

const onDragExit = (e) => {
    e.preventDefault();
    console.log('onDragExit');
};
</script>


<template>
    <div class="formbold-main-wrapper">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="formbold-form-wrapper">
            <form @dragover="onDragOver" @drop="onDrop" @dragleave="onDragLeave" @dragenter="onDragEnter"
                @dragend="onDragEnd" @dragstart="onDragStart" @drag="onDrag" @dragexit="onDragExit">

                <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                        Upload File
                    </label>

                    <div class="formbold-mb-5 formbold-file-input">
                        <input type="file" name="file" id="file" @change="onFileChange" multiple />
                        <label for="file">
                            <div>
                                <span class="formbold-drop-file"> Drop files here </span>
                                <span class="formbold-or"> Or </span>
                                <span class="formbold-browse"> Browse </span>
                            </div>
                        </label>
                    </div>

                    <div class="formbold-file-list formbold-mb-5">
                        <div class="formbold-file-item">
                            <span class="formbold-file-name"> banner-design.png </span>
                            <button>
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.279337 0.279338C0.651787 -0.0931121 1.25565 -0.0931121 1.6281 0.279338L9.72066 8.3719C10.0931 8.74435 10.0931 9.34821 9.72066 9.72066C9.34821 10.0931 8.74435 10.0931 8.3719 9.72066L0.279337 1.6281C-0.0931125 1.25565 -0.0931125 0.651788 0.279337 0.279338Z"
                                        fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.279337 9.72066C-0.0931125 9.34821 -0.0931125 8.74435 0.279337 8.3719L8.3719 0.279338C8.74435 -0.0931127 9.34821 -0.0931123 9.72066 0.279338C10.0931 0.651787 10.0931 1.25565 9.72066 1.6281L1.6281 9.72066C1.25565 10.0931 0.651787 10.0931 0.279337 9.72066Z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="formbold-file-list formbold-mb-5">
                        <div class="formbold-file-item">
                            <span class="formbold-file-name"> banner-design.png </span>
                            <button>
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.279337 0.279338C0.651787 -0.0931121 1.25565 -0.0931121 1.6281 0.279338L9.72066 8.3719C10.0931 8.74435 10.0931 9.34821 9.72066 9.72066C9.34821 10.0931 8.74435 10.0931 8.3719 9.72066L0.279337 1.6281C-0.0931125 1.25565 -0.0931125 0.651788 0.279337 0.279338Z"
                                        fill="currentColor" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.279337 9.72066C-0.0931125 9.34821 -0.0931125 8.74435 0.279337 8.3719L8.3719 0.279338C8.74435 -0.0931127 9.34821 -0.0931123 9.72066 0.279338C10.0931 0.651787 10.0931 1.25565 9.72066 1.6281L1.6281 9.72066C1.25565 10.0931 0.651787 10.0931 0.279337 9.72066Z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                        </div>
                        <div class="formbold-progress-bar">
                            <div class="formbold-progress"></div>
                        </div>
                    </div>
                </div>

                <div>
                    <button class="formbold-btn w-full" @click.prevent="uploadFile">Send File</button>
                </div>
            </form>
        </div>
    </div>
</template>


<style scoped></style>