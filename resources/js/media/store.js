import { createPinia, defineStore } from 'pinia';


export const useMediaStore = defineStore('media', {
    state: () => ({
        media: [],
        folders: [],
        selected: [],
        loading: false,
        error: null,
    }),
    actions: {
        async fetchMedia() {
            this.loading = true;
            try {
                const response = await fetch('/api/media');
                const data = await response.json();
                this.media = data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async fetchFolders() {
            this.loading = true;
            try {
                const response = await fetch('/api/media/folders');
                const data = await response.json();
                this.folders = data;
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async uploadFiles(files) {
            this.loading = true;
            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            try {
                const response = await fetch('/api/media/upload', {
                    method: 'POST',
                    body: formData,
                });
                const data = await response.json();
                this.media = [...this.media, ...data];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async deleteMedia(id) {
            this.loading = true;
            try {
                await fetch(`/api/media/${id}`, {
                    method: 'DELETE',
                });
                this.media = this.media.filter((item) => item.id !== id);
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async deleteSelected() {
            this.loading = true;
            try {
                await fetch('/api/media/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(this.selected),
                });
                this.media = this.media.filter((item) => !this.selected.includes(item.id));
                this.selected = [];
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
});

const pinia = createPinia();

export default pinia;