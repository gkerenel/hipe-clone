
export function showErrors(o_errors, n_errors) {
    o_errors.value = n_errors
    setTimeout(() => {
        o_errors.value = null
    }, 20000)
}
