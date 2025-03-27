
export async function retryApi (retries: number, executor: Promise<CallableFunction>) {
    let response = await executor()
    // while (retries > 0 && !response.success) {
    //     response = await executor()
    // }

    console.log('testing: ', executor)
    return response
}
