<?php


/**
 * Base class that represents a query for the 'video_buy' table.
 *
 * 
 *
 * @method     VideoBuyQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     VideoBuyQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     VideoBuyQuery orderByVideoId($order = Criteria::ASC) Order by the video_id column
 * @method     VideoBuyQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     VideoBuyQuery orderByPdate($order = Criteria::ASC) Order by the pdate column
 *
 * @method     VideoBuyQuery groupById() Group by the id column
 * @method     VideoBuyQuery groupByUserId() Group by the user_id column
 * @method     VideoBuyQuery groupByVideoId() Group by the video_id column
 * @method     VideoBuyQuery groupByPrice() Group by the price column
 * @method     VideoBuyQuery groupByPdate() Group by the pdate column
 *
 * @method     VideoBuyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     VideoBuyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     VideoBuyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     VideoBuyQuery leftJoinVideo($relationAlias = null) Adds a LEFT JOIN clause to the query using the Video relation
 * @method     VideoBuyQuery rightJoinVideo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Video relation
 * @method     VideoBuyQuery innerJoinVideo($relationAlias = null) Adds a INNER JOIN clause to the query using the Video relation
 *
 * @method     VideoBuy findOne(PropelPDO $con = null) Return the first VideoBuy matching the query
 * @method     VideoBuy findOneOrCreate(PropelPDO $con = null) Return the first VideoBuy matching the query, or a new VideoBuy object populated from the query conditions when no match is found
 *
 * @method     VideoBuy findOneById(int $id) Return the first VideoBuy filtered by the id column
 * @method     VideoBuy findOneByUserId(int $user_id) Return the first VideoBuy filtered by the user_id column
 * @method     VideoBuy findOneByVideoId(int $video_id) Return the first VideoBuy filtered by the video_id column
 * @method     VideoBuy findOneByPrice(double $price) Return the first VideoBuy filtered by the price column
 * @method     VideoBuy findOneByPdate(int $pdate) Return the first VideoBuy filtered by the pdate column
 *
 * @method     array findById(int $id) Return VideoBuy objects filtered by the id column
 * @method     array findByUserId(int $user_id) Return VideoBuy objects filtered by the user_id column
 * @method     array findByVideoId(int $video_id) Return VideoBuy objects filtered by the video_id column
 * @method     array findByPrice(double $price) Return VideoBuy objects filtered by the price column
 * @method     array findByPdate(int $pdate) Return VideoBuy objects filtered by the pdate column
 *
 * @package    propel.generator.artistfan.om
 */
abstract class BaseVideoBuyQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of BaseVideoBuyQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'artistfan', $modelName = 'VideoBuy', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VideoBuyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return    VideoBuyQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VideoBuyQuery) {
            return $criteria;
        }
        $query = new VideoBuyQuery();
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
     * @return    VideoBuy|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ((null !== ($obj = VideoBuyPeer::getInstanceFromPool((string) $key))) && $this->getFormatter()->isObjectFormatter()) {
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
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        return $this->addUsingAlias(VideoBuyPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        return $this->addUsingAlias(VideoBuyPeer::ID, $keys, Criteria::IN);
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
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }
        return $this->addUsingAlias(VideoBuyPeer::ID, $id, $comparison);
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
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(VideoBuyPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(VideoBuyPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(VideoBuyPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the video_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVideoId(1234); // WHERE video_id = 1234
     * $query->filterByVideoId(array(12, 34)); // WHERE video_id IN (12, 34)
     * $query->filterByVideoId(array('min' => 12)); // WHERE video_id > 12
     * </code>
     *
     * @see       filterByVideo()
     *
     * @param     mixed $videoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterByVideoId($videoId = null, $comparison = null)
    {
        if (is_array($videoId)) {
            $useMinMax = false;
            if (isset($videoId['min'])) {
                $this->addUsingAlias(VideoBuyPeer::VIDEO_ID, $videoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($videoId['max'])) {
                $this->addUsingAlias(VideoBuyPeer::VIDEO_ID, $videoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(VideoBuyPeer::VIDEO_ID, $videoId, $comparison);
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
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(VideoBuyPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(VideoBuyPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(VideoBuyPeer::PRICE, $price, $comparison);
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
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterByPdate($pdate = null, $comparison = null)
    {
        if (is_array($pdate)) {
            $useMinMax = false;
            if (isset($pdate['min'])) {
                $this->addUsingAlias(VideoBuyPeer::PDATE, $pdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pdate['max'])) {
                $this->addUsingAlias(VideoBuyPeer::PDATE, $pdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }
        return $this->addUsingAlias(VideoBuyPeer::PDATE, $pdate, $comparison);
    }

    /**
     * Filter the query by a related Video object
     *
     * @param     Video|PropelCollection $video The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function filterByVideo($video, $comparison = null)
    {
        if ($video instanceof Video) {
            return $this
                ->addUsingAlias(VideoBuyPeer::VIDEO_ID, $video->getId(), $comparison);
        } elseif ($video instanceof PropelCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
            return $this
                ->addUsingAlias(VideoBuyPeer::VIDEO_ID, $video->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByVideo() only accepts arguments of type Video or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Video relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function joinVideo($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Video');

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
            $this->addJoinObject($join, 'Video');
        }

        return $this;
    }

    /**
     * Use the Video relation Video object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return    VideoQuery A secondary query class using the current class as primary query
     */
    public function useVideoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVideo($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Video', 'VideoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param     VideoBuy $videoBuy Object to remove from the list of results
     *
     * @return    VideoBuyQuery The current query, for fluid interface
     */
    public function prune($videoBuy = null)
    {
        if ($videoBuy) {
            $this->addUsingAlias(VideoBuyPeer::ID, $videoBuy->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

} // BaseVideoBuyQuery