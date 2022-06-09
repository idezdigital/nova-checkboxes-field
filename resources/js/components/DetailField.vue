<template>
    <PanelItem :index="index" :field="field">
        <template #value class="tw-flex">
            <span class="tw-w-full tw-grid tw-grid-cols-2">
                <div
                    v-for="(label, option) in field.options"
                    :key="option"
                    class="tw-flex-auto"
                >
                    <span
                        :class="`tw-inline-block tw-rounded-full tw-w-2 tw-h-2 tw-mr-1 ${
                            optionIsActive(option)
                                ? 'tw-bg-green-500'
                                : 'tw-bg-red-500'
                        }`"
                    />
                    <span>{{ label }}</span>
                </div>
            </span>
        </template>
    </PanelItem>
</template>

<script>
export default {
    props: ["index", "resource", "resourceName", "resourceId", "field"],

    methods: {
        optionIsActive(option) {
            return this.field.value && this.field.value.includes(option);
        },
    },
};
</script>
