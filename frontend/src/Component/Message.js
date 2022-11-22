export default function Message(props) {
    if (!props.fromMe) {
        return (
            <div className='message p-3 rounded mb-3' style={{marginRight: '25%'}}>
                <p className='username'>{props.username}</p>
                <p>{props.content}</p>
            </div>
        )
    } else {
        return (
            <div className='message p-3 rounded mb-3 messageFromMe' style={{marginLeft: '25%'}}>
                <p className='username'>{props.username}</p>
                <p>{props.content}</p>
            </div>
        )
    }
}