<template>
    <select multiple class="custom-select">
        <slot></slot>
    </select>
</template>

<script>
import select2 from 'select2'
export default {
    props: ['options', 'value'],
    mounted() {
        var vm = this
        $(this.$el)
        // init select2
        .select2({
            data: this.options,
            width: '100%'
        })
        .val(this.value)
        .trigger('change')
        // emit event on change.
        .on('change', function () {
            vm.$emit('input', $(this).val())
        })
    },
    watch: {
        value: function (value) {
            if ([...value].sort().join(",") !== [...$(this.$el).val()].sort().join(","))
                $(this.$el).val(value).trigger('change');
        },
        options: function (options) {
            // update options
            $(this.$el).select2({ data: options })
        }
    },
    destroyed() {
        $(this.$el).off().select2('destroy')
    }
}
</script>

<style src="select2/dist/css/select2.min.css"></style>
<style>
    
</style>