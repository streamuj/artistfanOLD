<?php


/**
 * Base class that represents a query for the 'music_buy' table.
 *
 * 
 *
 * @method     MusicBuyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     MusicBuyQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     MusicBuyQuery orderByMusicId($order = Criteria::ASC) Order by the music_id column
 * @method     MusicBuyQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     MusicBuyQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     MusicBuyQuery groupById() Group by the id column
 * @method     MusicBuyQuery groupByUserId() Group by the user_id column
 * @method     MusicBuyQuery groupByMusicId() Group by the music_id column
 * @method     MusicBuyQuery groupByPrice() Group by the price column
 * @method     MusicBuyQuery groupByPdate() Group by the pdate column
 *
 * @method     MusicBuyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     MusicBuyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     MusicBuyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     MusicBuyQuery leftJoinMusic($relationAlias = null) Adds a LEFT JOIN clause to the query using the Music relation
 * @method     MusicBuyQuery rightJoinMusic($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Music relation
 * @method     MusicBuyQuery innerJoinMusic($relationAlias = null) Adds a INNER JOIN clause to the query using the Music relation
 *
 * @method     MusicBuy findOne(PropelPDO $con = null) Return the first MusicBuy matching the query
 * @method     MusicBuy findOneOrCreate(PropelPDO $con = null) Return the first MusicBuy matching the query, or a new MusicBuy object populated from the query conditions when no match is found
 *
 * @method     MusicBuy findOneById(int $id) Return the first MusicBuy filtered by the id column
 * @method     MusicBuy findOneByUserId(int $user_id) Return the first MusicBuy filtered by the user_id column
 * @method     MusicBuy findOneByMusicId(int $music_id) Return the first MusicBuy filtered by the music_id column
 * @method     MusicBuy findOneByPrice(double $price) Return the first MusicBuy filtered by the price column
 * @method     MusicBuy findOneByPdate(int $pdate) Return the first MusicBuy filtered by the pdate column
 *
 * @method     array findById(int $id) Return MusicBuy objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return MusicBuy objects filtered by the user_id column
 * @method     array findByMusicId(int $music_id) Return MusicBuy objects filtered by the music_id column
 * @method     array findByPrice(double $price) Return MusicBuy objects filtered by the price column
 * @method     array findByPdate(int $pdate) Return MusicBuy objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseMusicBuyQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseMusicBuyQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'artistfan', $modelName = 'MusicBuy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new MusicBuyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    MusicBuyQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof MusicBuyQuery) {
            return $criteria;
        }
        $query = new MusicBuyQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }
        return $query;
    }

    /**
     * Find object by primary key
     * Use instance pooling to avoid a database query if the object exists
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    MusicBuy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = MusicBuyPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
            // the object is alredy in the instance pool
            return $obj;
        } else {
            // the object has not been requested yet, or the formatter is not an object formatter
            $criteria = $this->isKeepQuery() ? clone $this : $this;
            $stmt = $criteria
                ->filterByPrimaryKey($key)
                ->getSelectStatement($con);
            return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
        }
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        return $this
            ->filterByPrimaryKeys($keys)
            ->find($con);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(MusicBuyPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(MusicBuyPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(MusicBuyPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(MusicBuyPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(MusicBuyPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(MusicBuyPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the music_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMusicId(1234); // WHERE music_id = 1234
     * $query->filterByMusicId(array(12, 34)); // WHERE music_id IN (12, 34)
     * $query->filterByMusicId(array('min' => 12)); // WHERE music_id > 12
     * </code>
     *
     * @see       filterByMusic()
     *
     * @param     mixed $musicId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterByMusicId($musicId = null, $comparison = null)
    {
        if (is_array($musicId)) {
            $useMinMax = false;
            if (isset($musicId['min'])) {
                $this->addUsingAlias(MusicBuyPeer::MUSIC_ID, $musicId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($musicId['max'])) {
                $this->addUsingAlias(MusicBuyPeer::MUSIC_ID, $musicId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(MusicBuyPeer::MUSIC_ID, $musicId, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(MusicBuyPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(MusicBuyPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(MusicBuyPeer::PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the pdate column
     *
     * Example usage:
     * <code>
     * $query->filterByPdate(1234); // WHERE pdate = 1234
     * $query->filterByPdate(array(12, 34)); // WHERE pdate IN (12, 34)
     * $query->filterByPdate(array('min' => 12)); // WHERE pdate > 12
     * </code>
     *
     * @param     mixed $pdate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterByPdate($pdate = null, $comparison = null)
    {
        if (is_array($pdate)) {
            $useMinMax = false;
            if (isset($pdate['min'])) {
                $this->addUsingAlias(MusicBuyPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pdate['max'])) {
                $this->addUsingAlias(MusicBuyPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(MusicBuyPeer::PDATE, $pdate, $comparison);
    }

    /**
     * Filter the query by a related Music object
     *
     * @param     Music|PropelCollection $music The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function filterByMusic($music, $comparison = null)
    {
        if ($music instanceof Music) {
            return $this
                ->addUsingAlias(MusicBuyPeer::MUSIC_ID, $music->getId(), $comparison);
        } elseif ($music instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
            return $this
                ->addUsingAlias(MusicBuyPeer::MUSIC_ID, $music->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMusic() only accepts arguments of type Music or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Music relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function joinMusic($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Music');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Music');
        }

        return $this;
    }

    /**
     * Use the Music relation Music object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    MusicQuery A secondary query class using the current class as primary query
     */
    public function useMusicQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMusic($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Music', 'MusicQuery');
    }

    /**
     * Exclude object from result
     *
     * @param     MusicBuy $musicBuy Object to remove from the list of results
     *
     * @return    MusicBuyQuery The current query, for fluid interface
     */
    public function prune($musicBuy = null)
    {
        if ($musicBuy) {
            $this->addUsingAlias(MusicBuyPeer::ID, $musicBuy->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseMusicBuyQuery