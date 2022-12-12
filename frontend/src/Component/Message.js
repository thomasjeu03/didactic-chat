export default function Message(props) {
    console.log(props)
    if (!props.fromMe) {
        return (
            <div className='message p-3 bg-black text-white rounded mb-3' style={{marginRight: '25%'}}>
                <p className='username bg-black text-white '>{props.username}</p>
                <p>{props.content}</p>
            </div>
        )
    } else {
        return (
            <div className='message p-3 rounded mb-3 bg-black text-white messageFromMe' style={{marginLeft: '25%'}}>
                <p className='username bg-black text-white'>{props.username}</p>
                <p>{props.content}</p>
            </div>
        )
    }
}