import React from 'react';
import API from '../../utils/API';
import Message from '../../components/Message/Message';
import InfiniteScroll from 'react-infinite-scroll-component';

class AllMessages extends React.Component {
    constructor() {
        super();
    }

    state = {
        messages: [],
        page: 0,
        hasMore: true
    }

    fetchMoreData = () => {
        // if (this.state.messages.length >= 500) {
        //   this.setState({ hasMore: false });
        //   return;
        // }

        // API.get("/message/read.php?page=" + this.state.page).then(response => {
        API.get("/messages/?page=" + this.state.page).then(response => {
            console.log(response);
            console.log(response.data);
            if (response.data.length > 0) {
                this.setState({
                    messages: this.state.messages.concat(response.data),
                    page: this.state.page + 10
                });
                console.log("this is data " + this.state['messages'][0]['message']);
            } else {
                this.setState({
                    hasMore: false
                });
            }
          });
    };

    messageViewHandler = (message_id, arrIndex, message) => {
        console.log("This is the message - " + message);
        console.log("Message clicked");
        console.log("it's - " + message_id);
        API.get("/users/check/?messageId="+message_id).then(response => {
            console.log(response);
            if (!response.data){                
                console.log("true");
                let changedViewers = [...this.state.messages];
                changedViewers[arrIndex]['viewers'] = parseInt(changedViewers[arrIndex]['viewers']) + 1;
                this.setState({ messages: changedViewers});
            }
          });
    };

    componentDidMount() {
       this.fetchMoreData();
    }

    render() {
        return (
                <InfiniteScroll
                        height="100%"
                        dataLength={this.state.messages.length}
                        next={this.fetchMoreData}
                        hasMore={this.state.hasMore}
                        loader={<h4>Loading...</h4>}
                        endMessage={
                            <p style={{ textAlign: "center" }}>
                            <b><br />You have seen it all !</b>
                            </p>
                        }
                        >
                    
                        {this.state.messages.map((data, index) => (
                            <Message message_id={data._id}   
                                    receiver={data.receiver}
                                    social_media_type={data.social_media_type}
                                    viewers={data.viewers}
                                    clickHandler={this.messageViewHandler}
                                    message={data.message}
                                    arrIndex={index}
                                    key={data._id}></Message>
                        ))}
                </InfiniteScroll>
        );
    }
}

export default AllMessages;