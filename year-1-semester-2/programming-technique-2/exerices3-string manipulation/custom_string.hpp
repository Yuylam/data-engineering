//? EXERCISE 3: STRING MANIPULATIONS
//? file: custom_string.cpp

//!----------------------------------------------------------------------------------------
//! This is the only file that you will need to modify in this exercise.
//! Also, you will submit only this file.
//! This file is the implementation for the class CustomString.
//!----------------------------------------------------------------------------------------

// Programming Technique II
// Semester 2, 2021/2022

// Section: 01
// Member 1's Name: Lam Yoke Yu A23CS0233

#include <iostream>
#include <string>
using namespace std;

#include "custom_string.hpp"

//?----------------------------------------------------------------------------------------
//? The following methods are fully given: a constructor, getData() and setData()
//?----------------------------------------------------------------------------------------

CustomString::CustomString(const string &_data) : data(_data) {}
string CustomString::getData() const { return data; }
void CustomString::setData(const string &_data) { data = _data; }

//! Task 1: Complete the implementation of the following mutator methods:
//!        (a) pushFront()
//!        (b) pushBack()
//!        (c) pop()
//!        (d) popFront()
//!        (e) popBack()

void CustomString::pushFront(const string &s)
{
    data = s + data;
    // Sample
    // data.insert(0, s);
}

void CustomString::pushBack(const string &s)
{
    data = data + s;
    // Sample
    // data.append(s);
}

string CustomString::pop(int index, int count)
{
    string ans = "", temp = "";
    for (int i = 0; i < count; i++){
        ans += data[index + i];
    }
    for(int i = 0; i < index; i++){
        temp += data[i];
    }
    for(int i = index + count; i < data.size(); i++){
        temp += data[i];
    }
    data = temp;
    return ans;
    // Sample
    // string temp = data.substr(index, count);
    // data.erase(index, count);
    // return temp;
}

string CustomString::popFront(int count)
{
    string ans = "", temp = "";
    for (int i = 0; i < count; i++){
        ans += data[i];
    }
    for(int i = count; i < data.size(); i++){
        temp += data[i];
    }
    data = temp;
    return ans;
    // Sample
    // return pop(0, count);
}

string CustomString::popBack(int count)
{
    string ans = "", temp = "";
    for (int i = data.size() - count; i < data.size(); i++){
        ans += data[i];
    }
    for(int i = 0; i < data.size() - count; i++){
        temp += data[i];
    }
    data = temp;
    return ans;
    // Sample
    // return pop(data.size() = count, count);
}

//! Task 2: Complete the implementation of the following overloaded operators:
//!        (a) operator !
//!        (b) operator *

CustomString CustomString::operator!() const
{
    string temp = "";
    for (int i = 0; i < data.size(); i++){
        temp += data[data.size() - i - 1];
    }
    return CustomString(temp);

    // Sample
    // string tmp = data;
    // int len = data.size();
    // for (int i = 0, j = len - 1; i < len; i++, j--)
    //     tmp[j] = data[i];

    // return CustomString(tmp);
}

CustomString CustomString::operator*(int count) const
{
    CustomString temp;
    temp.data = "";
    for (int i = 0; i < count; i++){
        temp.data += data;
    }
    return temp;
    
    // Sample
    // string tmp = "";
    // for (int i = 0; i < data.size(); i++)
    //     tmp = tmp + data;
    // return CustomString(tmp);
}

//! Task 3: Complete the implementation of the following conversion methods:
//!        (a) toDouble()
//!        (b) toUpper()

double CustomString::toDouble() const
{
    return stod(data);
}

CustomString CustomString::toUpper() const
{
    string temp = "";
    for(char s : data){
        temp += toupper(s);
    }
    return CustomString(temp);

    // Sample 
    // string tmp = data;
    // for (int i = 0; i < tmp.size(); i++)
    //     tmp[i] = toupper(tmp[i]);

    // return CustomString(tmp);
}