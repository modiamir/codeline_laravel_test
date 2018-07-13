<template>
    <div class="media-body">
        <h5 class="mt-0 mb-1">{{ comment.subject }}</h5>
        {{ comment.body }}
    </div>
</template>

<script>
    export default {
        props: {
            comment: {
                type: Object
            }
        }
    }
</script>
