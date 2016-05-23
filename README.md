[![Build Status](https://travis-ci.org/ikr/fyrfyrfyr.svg?branch=master)](https://travis-ci.org/ikr/fyrfyrfyr)

# About

Basic tools for composing functions, to write simpler and safer programs in PHP 5.4+. Heavily
inspired by [@drboolean](https://twitter.com/drboolean)'s
[book](https://drboolean.gitbooks.io/mostly-adequate-guide/content/), the
[Ramda](http://ramdajs.com/) library, and the
[Fantasy Land](https://github.com/fantasyland/fantasy-land) JS project.

![fox logo](https://ikr.su/h/img/fyrfyrfyr.png)

# Why?

This library grew out of frustration with old PHP code I have to maintain. I'm convinced that
functional programming can lead us [Out of the Tar Pit](http://shaffner.us/cs/papers/tarpit.pdf). I
do know about [Phamda](https://github.com/mpajunen/phamda) and
[Pramda](https://github.com/kapolos/pramda); very cool projects, but they both require PHP
5.6+. Then, I was also not 100% on board with some design choices those 2 make. I'd like to keep
fyr-fyr-fyr tiny and lean, away from all sorts of cruft and magic. In many ways that's a matter of
taste though.

# API

## Constructing functions

### Composition

    (f⋅g⋅h)(x) <-> f(g(h(x)))

### Currying

    f(x, y) <-> f(x)(y)

### Flipping the arguments

    flip

## Primary higher order functions

    map
    chain
    converge

## Associative arrays

    assoc
    assocPath
    fromPairs
    merge
    mergeAll
    pick
    pickAll
    prop
    propOr

## Lists

    append
    indexBy

## Utilities

    always
    identity
    inc

## Algebraic structures

    IO
    Maybe

# Status: WORK IN PROGRESS

Not yet ready for using in production
