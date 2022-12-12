export default function useBackendPing() {

    return function (userId) {
        return fetch(`http://localhost:8245/ping/${userId}`, {
            method: 'POST',
            credentials: 'include',
            mode: 'cors',
            headers: {
                'Content-Type': 'application/json'
            },
        })
            .then(data => data.json())
            .then(data => data.message)
    }
}