<!-- resources/js/media/MediaManager.vue -->
<template>
    <div class="formbold-main-wrapper">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="formbold-form-wrapper">
            <form action="https://formbold.com/s/FORM_ID" method="POST">
                <div class="mb-6 pt-4">
                    <label class="formbold-form-label formbold-form-label-2">
                        Upload File
                    </label>

                    <section class="photo-gallery mt-5 mb-5 text-center">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 gallery-grid">
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/251/1200/800.webp">
                                        <img src="https://picsum.photos/id/251/480/320.webp" class="img-fluid"
                                            alt="Lorem ipsum dolor sit amet">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/678/1200/800.webp">
                                        <img src="https://picsum.photos/id/678/480/320.webp" class="img-fluid"
                                            alt="Ipsum lorem dolor sit amet">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/74/1200/800.webp">
                                        <img src="https://picsum.photos/id/74/480/320.webp" class="img-fluid"
                                            alt="Dolor lorem ipsum sit amet">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/92/1200/800.webp">
                                        <img src="https://picsum.photos/id/92/480/320.webp" class="img-fluid"
                                            alt="Sit amet lorem ipsum dolor">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/62/1200/800.webp">
                                        <img src="https://picsum.photos/id/62/480/320.webp" class="img-fluid"
                                            alt="Aut ipsam deserunt nostrum quo">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/575/1200/800.webp">
                                        <img src="https://picsum.photos/id/575/480/320.webp" class="img-fluid"
                                            alt="Nulla ex nihil eligendi tempora">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/110/1200/800.webp">
                                        <img src="https://picsum.photos/id/110/480/320.webp" class="img-fluid"
                                            alt="Nemo perspiciatis voluptatum">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/177/1200/800.webp">
                                        <img src="https://picsum.photos/id/177/480/320.webp" class="img-fluid"
                                            alt="Accusantium consequuntur modi">
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="gallery-item" href="https://picsum.photos/id/197/1200/800.webp">
                                        <img src="https://picsum.photos/id/197/480/320.webp" class="img-fluid"
                                            alt="Dolore asperiores reprehenderit">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <div class="modal fade lightbox-modal" id="lightbox-modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                            <div class="modal-content">
                                <button type="button" class="btn-fullscreen-enlarge" aria-label="Enlarge fullscreen">
                                    <svg class="bi">
                                        <use href="#enlarge"></use>
                                    </svg>
                                </button>
                                <button type="button" class="btn-fullscreen-exit d-none" aria-label="Exit fullscreen">
                                    <svg class="bi">
                                        <use href="#exit"></use>
                                    </svg>
                                </button>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <div class="modal-body">
                                    <div class="lightbox-content">
                                        <!-- JS content here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="formbold-btn w-full">Send File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
// Composition API setup logic can go here
</script>

<style scoped></style>