<template>
    <PanelItem :index="index" :field="field">
        <template #value class="text-90 flex">
            <span class="w-full grid grid-cols-2">
                <div
                    v-for="(label, option) in field.options"
                    :key="option"
                    class="flex-auto"
                >
                    <span
                        :class="`inline-block rounded-full w-2 h-2 mr-1 ${
                            optionIsActive(option)
                                ? 'bg-green-500'
                                : 'bg-red-500'
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
