export default function useGetJWT() {

    return function (username, password) {
        const credentials = btoa(`${username}:${password}`);

        return fetch(`http://localhost:8245/login`, {
            method: 'POST',
            credentials: 'include',
            mode: 'cors',
            headers: {
                'Authorization': `Basic ${credentials}`
            }
        }).then(data => data.json())
    }
}