import { Pressable, FlatList, SectionList, StyleSheet } from 'react-native';

import EditScreenInfo from '../components/EditScreenInfo';
import { Text, View } from '../components/Themed';
import { RootTabScreenProps } from '../types';

import useGetUserList from "../Hook/useGetUserList";
import {useState, useEffect} from "react";

export default function TabOneScreen({ navigation }: RootTabScreenProps<'TabOne'>) {
    const getUserList = useGetUserList();
    const [users, setUsers] = useState([]);

    useEffect(() => {
        getUserList().then(data => {
            setUsers(data.users);
            console.log(data.users);
        })
    }, []);

    return (
    <View style={styles.container}>
      <Text style={styles.title}>Let's chat now</Text>
      <View style={styles.separator} lightColor="#eee" darkColor="rgba(255,255,255,0.1)" />
      <View style={styles.listingUsers}>
          {users?.map((u) => (
             <Pressable key={u.id} style={styles.item}>
                 <Text style={styles.text}>{u.username}</Text>
             </Pressable>
          ))}
          <Text>{users}</Text>
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 30,
    alignItems: 'flex-start',
    justifyContent: 'flex-start',
  },
  title: {
    fontSize: 20,
    fontWeight: 'bold',
  },
  separator: {
    marginVertical: 15,
    height: 1,
    width: '100%',
  },
  listingUsers: {
    height: '95%',
    width: '100%',
  },
  item: {
    padding: 10,
    marginBottom: 10,
    borderRadius: 10,
    backgroundColor: '#d0efe8',
    fontSize: 18,
    height: 44,
  },
    text: {
        lineHeight: 23,
    },
});
